<?php include 'conexao.php'; ?>
<?php $global = mysqli_query($conn, "SELECT * FROM bot where tipo = 1") or die("Error"); ?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>

<body>
    <div class="wrapper">

        <div class="title">
            Clear Helper
        </div>

        <div class="form">
            <div class="bot-inbox inbox">

                <div class="icon">
                    <img src="./brand-orange-dark-background.png" class="img-fluid" alt="">
                </div>

                <div class="msg-header">
                    <p>
                        Bem vindo ao clear helper, comandos disponíveis abaixo:

                        <br>
                        <br>

                        <?php while ($row = mysqli_fetch_assoc($global)) : ?>
                            <span>○ <?php echo $row['query']; ?> </span> <br>
                        <?php endwhile; ?>

                    </p>
                </div>

            </div>
        </div>

        <div class="typing-field">
            <div class="input-data">
                <div class="box">

                    <span id="gif-typing" style="display: none">
                        O agente está digitando, aguarde.
                        <img src="https://bearghost.b-cdn.net/wp-content/uploads/2019/09/dots.gif" alt="">
                    </span>
                </div>

                <input id="data" type="text" placeholder="Digite aqui" required>
                <button id="send-btn">Enviar</button>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $("#send-btn").on("click", function() {

                $value = $("#data").val();
                $msg = '<div class="user-inbox inbox"><div class="msg-header"><p>' + $value + '</p></div></div>';
                $(".form").append($msg);
                $("#data").val('');
                $("#gif-typing").show();

                setTimeout(() => {
                    // start ajax code
                    $.ajax({
                        url: 'message.php',
                        type: 'POST',
                        data: 'text=' + $value,
                        success: function(result) {
                            $replay = '<div class="bot-inbox inbox"><div class="icon"><img src="./brand-orange-dark-background.png" class="img-fluid" alt=""></div><div class="msg-header"><p>' + result + '</p></div></div>';
                            $(".form").append($replay);
                            // when chat goes down the scroll bar automatically comes to the bottom
                            $(".form").scrollTop($(".form")[0].scrollHeight);
                        }
                    });

                    $("#gif-typing").hide();

                }, 2000);
            });
        });
    </script>

</body>

</html>