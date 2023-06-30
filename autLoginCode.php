<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Send Code For Login Verification</title>
    <style>
        input {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: textfield;
            margin: 0;
            width: 25px;
            height: 25px;
            font-size: 25px;
            text-align: center;
            border-color: red;
            border-radius: 5px;
        }

        #codalani {
            margin: 2% auto;
            width: max-content;
            border: 3px solid darkslategray;
            border-radius: 3%;
            padding: 4%;
        }

        #btnarea {
            margin-top: 10%;
        }

        #btnarea #btn {
            background: darkred;
            padding: 3%;
            width: 100%;
            color: white;
            font-size: 15px;
            border-radius: 5px;
            border: unset;
            font-weight: bold;
        }

        .buton {
            margin-top: 10%;
            padding: 1%;
            width: 100%;
        }

    </style>
</head>
<body>

<div id="codalani">

    <form action="" method="post">

        <input type="number" name="code[]">
        <input type="number" name="code[]">
        <input type="number" name="code[]">
        <input type="number" name="code[]">
        <input type="number" name="code[]">
        <input type="number" name="code[]">

        <div id="btnarea">
            <button id="btn" type="submit">GÖNDER</button>
        </div>

    </form>
    <?php
    if ($_POST) {
        echo "<br><br>";
        echo "Gelen Kod: " . implode($_POST["code"]);
    } ?>

</div>

<script>

    let inputs = document.getElementsByName("code[]");
    let s = 0;
    let num = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
    let codalani = document.getElementById("codalani");

    function paste(e) {

        let code = e.clipboardData.getData("Text");

        if (isNaN(code)) {
            alert("Girilen değerleri sayısal değerler değildir. ");
            e.preventDefault();
            return;
        } else if (code.length < 6) {
            alert("Girilen değer 6 rakamlı olmalıdır.");
            e.preventDefault();
            return;
        }

        code = code.trim();
        code = code.replace(" ", "");


        for (let i = 0; i < inputs.length; i++) {
            inputs[i].value = code[i];
        }

        s = 5
    }

    document.addEventListener("paste", e => {

        e.preventDefault();
        paste(e);

    })


    document.getElementById("btn").addEventListener("click", e => {

        for (let i = 0; i < inputs.length; i++) {

            if (inputs[i].value.length !== 1) {
                alert("Kod alanı tamamı dolu olmalıdır.");
                e.preventDefault();
                break;
            }

        }
    })


    codalani.addEventListener("keydown", e => {

        if (e.key === 'Backspace') {

            if (s >= 0) {
                inputs[s].value = "";
                inputs[s].blur();
                s--;
                if (s > -1)
                    inputs[s].focus();
            }
            if (s < 0) s = 0;

        }

        if (num.includes(Number.parseInt(e.key))) {

            e.preventDefault();
            inputs[s].value = e.key;
            inputs[s].blur();

            if (s !== 5) {
                inputs[s + 1].focus();
                s++;
            } else {
                s = 0
                document.getElementById("btn").focus();
                alert("1.5 Saniye sonra tamam butonuna otomatik tıklanılacak.");
                setTimeout(function () {
                    document.getElementById("btn").click()
                }, 1500);
            }

        }

    })

    const btn = document.createElement("button");
    btn.setAttribute("class", "buton");
    btn.setAttribute("onclick", "dosyaDown()");
    btn.innerText = "PROJEYİ İNDİR";
    document.getElementsByTagName("div")[0].appendChild(btn);

    function dosyaDown() {
        const path = window.location.pathname;
        document.location.href = path.substring(0, path.lastIndexOf('/')) + "/pastecode.zip";
    }

</script>
</body>
</html>