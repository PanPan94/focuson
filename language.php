<?php
    session_start();
    require_once('inc/functions.php');
    if(isset($_GET['unset'])) {
        unset($_SESSION['lang']);
        header('Location: language.php');
        exit();
    }
    if(isset($_POST['language'])) {
        $_SESSION['lang'] = $_POST['language'];
        header('Location: login.php');
        exit();
    }
    setHeaderName('Choose your language');
    
?>
<div class="home">
    <div class="home-container">
        <div class="home-logo">
            <img src="./img/logo.svg" alt="logo">
        </div>

        <div class="header-hello">
            <h2 id="hello">Select your language</h2>
        </div>
        <form action="" id="form-language" class="form-language"  method="POST">
            <div class="language-selector">
                    <a id="french" class="btn language french unselected" data-hello="Selectionnez votre langue">
                        <input class="language-input" type="radio" name="language" value="fr">
                    </a>
                    <a id="english" class="btn language english selected" data-hello="Select your language">
                        <input class="language-input" type="radio" name="language" value="en" checked>
                    </a>
                    <a id="bulgaria" class="btn language bulgaria selected" data-hello="Изберете вашия език">
                        <input class="language-input" type="radio" name="language" value="bul" >
                    </a>
            </div>
            <a class="btn" id="discover" href="#"><b>Discover</b></a>
        </form>
    </div>
</div>
<script>
    let languages = document.querySelectorAll('.language');
    languages.forEach(l => {
        l.addEventListener('click', e => {
            languages.forEach(s => {
                if(s.classList.contains('selected')){
                    s.classList.remove('selected');
                    s.classList.add('unselected');
                }
            })
            l.classList.remove('unselected');
            l.classList.add('selected');

            let hello = l.getAttribute("data-hello");
            document.querySelector('#hello').innerText = hello;
            if(document.querySelector('#english').classList.contains('selected')){
                document.querySelector('#discover b').innerText = "Discover";
            }else if(document.querySelector('#french').classList.contains('selected')){
                document.querySelector('#discover b').innerText = "Découvrir";
            }else {
                document.querySelector('#discover b').innerText = "откривам";
            }
        });
    });

    document.querySelector('#discover').addEventListener('click', () => {
        document.querySelector('#form-language').submit();
    })
</script>
