<html>

<head>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/css/materialize.min.css">
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>
  <style>
    body {
      display: flex;
      min-height: 100vh;
      flex-direction: column;
    }

    main {
      flex: 1 0 auto;
    }

    body {
      background: #fff;
    }

    .input-field input[type=date]:focus + label,
    .input-field input[type=text]:focus + label,
    .input-field input[type=email]:focus + label,
    .input-field input[type=password]:focus + label {
      color: #e91e63;
    }

    .input-field input[type=date]:focus,
    .input-field input[type=text]:focus,
    .input-field input[type=email]:focus,
    .input-field input[type=password]:focus {
      border-bottom: 2px solid #e91e63;
      box-shadow: none;
    }
  </style>
</head>

<body>
  <div class="section"></div>
    <main>
        <center>
        <img class="responsive-img" style="width: 250px;" src="https://mikroskil.ac.id/bundles/mikroskilglobal/images/logo_with_background.png" />
        <div class="section"></div>

        <h5 class="indigo-text">Mikroskil OpenVPN</h5>
        <div class="section"></div>

        <div class="container">
            <div class="z-depth-1 grey lighten-4 row" style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px solid #EEE;">

            <div class="col s12" >

                <div class='row'>
                <div class='input-field col s12'>
                    <input class='validate' type='text' name='nim' id='nim' />
                    <label for='nim'>Masukan NIM Mahasiswa</label>
                    <button data-target="modal1" type='submit' id='create_user' class='col s12 btn btn-large waves-effect indigo'>Buat Akun</button>
                </div>
                </div>
            </div>
            </div>
        </div>
        </center>
    </main>
    
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            // Kirim data ke generateUser.php
            $("#create_user").click(function () {
                console.log("trigger");
                var nim_mhs = $('#nim').val();
                $.ajax({
                url: 'generateUser.php',
                type: 'POST',
                data: { nim : nim_mhs },
                beforeSend: function() { 
                  $('#container').html("<img src='https://i0.wp.com/www.printmag.com/wp-content/uploads/2021/02/4cbe8d_f1ed2800a49649848102c68fc5a66e53mv2.gif?fit=476%2C280&ssl=1' />");
                  $('#modal').openModal();
                },
                success: function(response){
                    // alert(response)
                    $('#modal').closeModal();
                    $('#urlDownload').html(response);
                    $('#modal').openModal();
                }
                });
            });
            
            // Tolak Inputan Space (spasi)
            $("input#nim").on({
                keydown: function(e) {
                    if (e.which === 32)
                    return false;
                },
                change: function() {
                    this.value = this.value.replace(/\s/g, "");
                }
            });
        });
    </script>
    <!-- Modal -->
    <div id="modal" class="modal">
    <div class="modal-content" id="container">
      <h4>Info</h4>
      <span id="urlDownload"></span>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Tutup</a>
    </div>
</div>
</body>

</html>