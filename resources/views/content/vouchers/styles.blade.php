<style>
  .container-xxl, .container-xl, .container-lg, .container-md, .container-sm, .container {
    max-width: 1400px;
  }

  #select-dropdown-query{
    max-height: 250px;
    overflow-y: scroll
  }

  #select-dropdown-content {
    display: none;
    position: absolute;
    background-color: #fff;
    min-width: 230px;
    border: 1px solid #ddd;
    z-index: 9999;
    margin-top: 5px;
    border-radius: 3px;
  }

  @media(max-width:720px){
    #select-dropdown-content {
      width: 90%;
    }
  }

  #select-dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
  }

  #select-dropdown-content a:hover {background-color: #f1f1f1}
</style>
