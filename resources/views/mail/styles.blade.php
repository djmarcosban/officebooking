<style>
  /* Base */

  body,
  body *:not(html):not(style):not(br):not(tr):not(code) {
    box-sizing: border-box;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif,
      'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';
    position: relative;
  }

  body {
    -webkit-text-size-adjust: none;
    background-color: #ffffff;
    color: #333;
    height: 100%;
    line-height: 1.4;
    margin: 0;
    padding: 0;
    width: 100% !important;
  }

  p,
  ul,
  ol,
  blockquote {
    line-height: 1.4;
    text-align: left;
  }

  a {
    color: #3869d4;
  }

  a img {
    border: none;
  }

  /* Typography */

  h1 {
    color: #000;
    font-size: 22px;
    font-weight: bold;
    margin-top: 0;
    text-align: center;
  }

  h2 {
    font-size: 16px;
    font-weight: bold;
    margin-top: 0;
    text-align: left;
  }

  h3 {
    font-size: 14px;
    font-weight: bold;
    margin-top: 0;
    text-align: left;
  }

  p {
    font-size: 16px;
    line-height: 1.5em;
    margin-top: 0;
    text-align: left;
  }

  p.sub {
    font-size: 12px;
  }

  img {
    max-width: 100%;
  }

  /* Layout */

  .wrapper {
    -premailer-cellpadding: 0;
    -premailer-cellspacing: 0;
    -premailer-width: 100%;
    background-color: #f9f9f9;
    margin: 0;
    padding: 0;
    width: 100%;
    border-radius: 0 !important
  }

  .content {
    -premailer-cellpadding: 0;
    -premailer-cellspacing: 0;
    -premailer-width: 100%;
    box-shadow: rgba(153, 153, 153, 0.2) 0px 2px 4px 0px;
    margin: 0;
    padding: 0;
    width: 100%;
    border-radius: 0 !important
  }

  /* Header */

  .header {
    padding: 25px 0;
    text-align: center;
  }

  .header a {
    color: #3d4852;
    font-size: 19px;
    font-weight: bold;
    text-decoration: none;
  }

  /* Logo */
  .logo img,
  .logo {
    width: 90px;
    object-fit: contain;
  }

  /* Body */

  .body {
    -premailer-cellpadding: 0;
    -premailer-cellspacing: 0;
    -premailer-width: 100%;
    background-color: #f9f9f9;
    border-bottom: 1px solid #f9f9f9;
    border-top: 1px solid #f9f9f9;
    margin: 0;
    padding: 0;
    width: 100%;
  }

  .inner-body {
    -premailer-cellpadding: 0;
    -premailer-cellspacing: 0;
    -premailer-width: 570px;
    background-color: #ffffff;
    border-color: #e8e5ef;
    border-radius: 2px;
    border-width: 1px;
    box-shadow: rgba(153, 153, 153, 0.2) 0px 2px 4px 0px;
    margin: 0 auto;
    padding: 0;
    width: 570px;
  }

  /* Subcopy */

  .subcopy {
    border-top: 1px solid #e8e5ef;
    margin-top: 25px;
    padding-top: 25px;
    border-radius: 0 !important
  }

  .subcopy p {
    font-size: 14px;
  }

  /* Footer */

  .footer {
    -premailer-cellpadding: 0;
    -premailer-cellspacing: 0;
    -premailer-width: 570px;
    margin: 0 auto;
    padding: 0;
    text-align: center;
    width: 570px;
    font-size: 13px !important;

  }

  .footer td,
  .footer td a {
    font-size: 13px !important;
  }

  .footer p {
    color: #444;
    font-size: 13px;
    text-align: center;
  }

  .footer a {
    color: #70499f;
    font-size: 13px !important;
    text-decoration: underline;
  }

  /* Tables */

  .table table {
    -premailer-cellpadding: 0;
    -premailer-cellspacing: 0;
    -premailer-width: 100%;
    margin: 30px auto;
    width: 100%;
  }

  .table th {
    border-bottom: 1px solid #edeff2;
    margin: 0;
    padding-bottom: 8px;
  }

  .table td {
    color: #74787e;
    font-size: 15px;
    line-height: 18px;
    margin: 0;
    padding: 10px 0;
  }

  .content-cell {
    max-width: 100vw;
    padding: 32px;
  }

  /* Buttons */

  .action {
    -premailer-cellpadding: 0;
    -premailer-cellspacing: 0;
    -premailer-width: 100%;
    margin: 30px auto;
    padding: 0;
    text-align: center;
    width: 100%;
  }

  .button {
    -webkit-text-size-adjust: none;
    border-radius: 4px;
    color: #fff;
    display: inline-block;
    overflow: hidden;
    text-decoration: none;
  }

  .btn {
    font-weight: 700;
    line-height: 1.53;
    color: #697a8d;
    text-align: center;
    vertical-align: middle;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background-color: transparent;
    border: 1px solid transparent;
    padding: 7px 26px;
    font-size: 15px;
    border-radius: 50px;
    transition: all .1s ease-in-out;
    align-items: center;
    display: flex;
    justify-content: center;
  }

  .btn-primary {
    background-color: #70499f;
    border-color: #70499f;
    color: #fff;
  }

  .btn-sm,
  {
  padding: 0.25rem 0.6875rem;
  font-size: 1rem;
  border-radius: 50rem;
  height: auto;
  }

  .button-green,
  .button-success {
    background-color: #48bb78;
    border-bottom: 8px solid #48bb78;
    border-left: 18px solid #48bb78;
    border-right: 18px solid #48bb78;
    border-top: 8px solid #48bb78;
  }

  .button-red,
  .button-error {
    background-color: #e53e3e;
    border-bottom: 8px solid #e53e3e;
    border-left: 18px solid #e53e3e;
    border-right: 18px solid #e53e3e;
    border-top: 8px solid #e53e3e;
  }

  /* Panels */

  .panel {
    border-left: #fd8913 solid 4px;
    margin: 21px 0;
  }

  .panel-content {
    background-color: #f9f9f9;
    color: #70499f;
    padding: 16px;
  }

  .panel-content p {
    color: #70499f;
  }

  .panel-item {
    padding: 0;
  }

  .panel-item p:last-of-type {
    margin-bottom: 0;
    padding-bottom: 0;
  }

  /* Utilities */

  .break-all {
    word-break: break-all;
  }

  .app-brand-logo {
    display: block;
    flex-grow: 0;
    flex-shrink: 0;
    overflow: hidden;
    min-height: 1px;
  }

  .app-brand {
    line-height: 1;
  }
</style>