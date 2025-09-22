<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
  public function up(): void
  {
    // FUNCTION
    DB::unprepared("
    DROP FUNCTION IF EXISTS fn_is_professor;
    DELIMITER $$
    CREATE FUNCTION fn_is_professor(p_user_id INT)
    RETURNS TINYINT DETERMINISTIC
    BEGIN
      DECLARE v_cnt INT DEFAULT 0;
      IF p_user_id IS NULL THEN
        RETURN 0;
      END IF;
      SELECT COUNT(*) INTO v_cnt
        FROM users
      WHERE id = p_user_id
        AND funcao = 'professor';
      RETURN IF(v_cnt > 0, 1, 0);
    END$$
    DELIMITER ;
    ");

    // VIEW
    DB::unprepared("
    DROP VIEW IF EXISTS vw_reservas_basico;
    DELIMITER $$
    CREATE VIEW vw_reservas_basico AS
    SELECT
      r.id,
      r.status,
      r.professor_id,
      u.nome            AS professor_nome,
      r.inventario_id,
      i.nome            AS inventario_nome,
      r.instituicao_id,
      inst.nome         AS instituicao_nome,
      r.data,
      r.horario,
      r.created_at,
      r.updated_at
    FROM reservas r
    LEFT JOIN users        u   ON u.id   = r.professor_id
    LEFT JOIN inventarios  i   ON i.id   = r.inventario_id
    LEFT JOIN instituicaos inst ON inst.id = r.instituicao_id$$
    DELIMITER ;
    ");

    // TRIGGERS
    // Antes de INSERT: só professor cria; e professor_id tem que ser professor
    DB::unprepared("
    DROP TRIGGER IF EXISTS tr_reservas_prof_bi;
    DELIMITER $$
    CREATE TRIGGER tr_reservas_prof_bi
    BEFORE INSERT ON reservas
    FOR EACH ROW
    BEGIN
      IF fn_is_professor(NEW.create_user_id) = 0 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Apenas usuário com função \"professor\" pode criar reserva.';
      END IF;

      IF fn_is_professor(NEW.professor_id) = 0 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'O campo professor_id deve apontar para um usuário com função \"professor\".';
      END IF;
    END$$
    DELIMITER ;
    ");

    // Antes de UPDATE: impedir trocar professor_id pra alguém que não seja professor
    DB::unprepared("
    DROP TRIGGER IF EXISTS tr_reservas_prof_bu;
    DELIMITER $$
    CREATE TRIGGER tr_reservas_prof_bu
    BEFORE UPDATE ON reservas
    FOR EACH ROW
    BEGIN
      IF NEW.professor_id <> OLD.professor_id AND fn_is_professor(NEW.professor_id) = 0 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'professor_id deve ser um usuário com função \"professor\".';
      END IF;
    END$$
    DELIMITER ;
    ");

    // PROCEDURE
    DB::unprepared("
    DROP PROCEDURE IF EXISTS sp_criar_reserva;
    DELIMITER $$
    CREATE PROCEDURE sp_criar_reserva(
      IN p_professor_id   INT,
      IN p_inventario_id  INT,
      IN p_instituicao_id INT,
      IN p_data           VARCHAR(255),
      IN p_horario        VARCHAR(255),
      IN p_descricao      VARCHAR(255),
      IN p_user_id        INT,
      OUT p_reserva_id    BIGINT
    )
    BEGIN
      -- Quem esta criando precisa ser professor
      IF fn_is_professor(p_user_id) = 0 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Só professor pode criar reserva.';
      END IF;

      -- E o professor_id referenciado também precisa ser professor
      IF fn_is_professor(p_professor_id) = 0 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'professor_id deve ser de um usuário com função \"professor\".';
      END IF;

      INSERT INTO reservas (
        professor_id, inventario_id, instituicao_id, status, data, horario, descricao,
        create_user_id, update_user_id, created_at, updated_at
      ) VALUES (
        p_professor_id, p_inventario_id, p_instituicao_id, 'pendente', p_data, p_horario, p_descricao,
        p_user_id, p_user_id, NOW(), NOW()
      );

      SET p_reserva_id = LAST_INSERT_ID();
    END$$
    DELIMITER ;
    ");
  }

  public function down(): void
  {
    DB::unprepared("DROP PROCEDURE IF EXISTS sp_criar_reserva;");
    DB::unprepared("DROP TRIGGER IF EXISTS tr_reservas_prof_bu;");
    DB::unprepared("DROP TRIGGER IF EXISTS tr_reservas_prof_bi;");
    DB::unprepared("DROP VIEW IF EXISTS vw_reservas_basico;");
    DB::unprepared("DROP FUNCTION IF EXISTS fn_is_professor;");
  }
};