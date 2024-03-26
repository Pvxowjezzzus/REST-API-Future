<?php
session_start();
use notebook\Handler;
include('handler.php');
$handler = new Handler;
$edit = $handler->getNoteData();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Тестовое задание</title>
    <link rel="stylesheet" href="styles/style.css">
</head>

<body>
    <div class="container">
        <div class="header">
            <?php if(!isset($_SESSION['id']) && empty($_SESSION['id'])):?>
            <h1>Записная книжка</h1>
            <?php else:?>
            <h1>Редактирование записи № <?=$_SESSION['id']?></h1>
            <?php endif;?>
        </div>
        <div class="content">
            <form action="/handler.php" method="POST" class="contact-form" id="contactForm">
            <?php if(!isset($_SESSION['id']) && empty($_SESSION['id'])):?>
                <div class="input-block">
                    <div class="text-part">
                        <label for="fio">ФИО
                            <span class="required-input">*</span>
                        </label>
                    </div>
                    <input type="text" name="fio" class="input" id="fio" required>
                </div>
                <div class="input-block">
                    <div class="text-part">
                        <label for="company">Компания</label>
                    </div>  
                        <input type="text" name="company" class="input" id="company">
                </div>
                <div class="input-block">
                    <div class="text-part">
                        <label for="phone">Телефон
                            <span class="required-input">*</span>
                        </label>
                    </div>
                    
                    <input type="text" name="phone" title="Формат номера: +79161234567" class="input" id="phone" required>
                </div>
                <div class="input-block">
                    <div class="text-part">
                       <label for="email">Email
                            <span class="required-input">*</span>
                        </label>  
                    </div>
                    <input type="email" name="email" class="input" id="email" required>
                </div>
                <div class="input-block">
                    <label for="date">Дата рождения</label>
                    <input type="date" name="date" class="input" id="phone">
                </div>
         
                <div class="upload-photo__wrapper input-block">
                    <input type="file" name="photo" id="photo" class="upload-photo__input"    accept="image/jpeg,image/png,image/webp,image/gif">
                    <label class="upload-photo__label" for="photo">
                        <span class="upload-photo__text" title="Прикрепить можно только один файл">Прикрепить фото</span>
                    </label>
                    <span class="selected_filename" id="selected_filename">Файл не выбран</span>
                </div>
                <?php else:?>
                    <div class="input-block">
                    <div class="text-part">
                        <label for="fio">ФИО
                            <span class="required-input">*</span>
                        </label>
                    </div>
                    <?php foreach ($edit as $val): ?>
                    <input type="text" name="fio" class="input" value="<?=$val['fio']?>" id="fio" required>
                </div>
                <div class="input-block">
                    <div class="text-part">
                        <label for="company">Компания</label>
                    </div>
                    <input type="text" name="company"  value="<?php echo ($val['company'] !== "null" && $val['company'] !== "") ? $val['company'] : ""?>" class="input" id="company">
                </div>
                <div class="input-block">
                    <div class="text-part">
                        <label for="phone">Телефон
                            <span class="required-input">*</span>
                        </label>
                    </div>
                    <input type="text" name="phone" value="<?=$val['phone']?>" title="Формат номера: +79161234567" class="input" id="phone" required>
                </div>
                <div class="input-block">
                    <div class="text-part">
                       <label for="email">Email
                            <span class="required-input">*</span>
                        </label>  
                    </div>
                    <input type="email" name="email" value="<?=$val['email']?>" class="input" id="email" required>
                </div>
                <div class="input-block">
                    <label for="date">Дата рождения</label>
                    <input type="date" name="date" class="input" value="<?php echo ($val['birth_date'] !== "null") ? $val['birth_date'] : ""?>" id="birth_date">
                </div>
                <div class="upload-photo__wrapper input-block">
                    <input type="file" name="photo" id="photo" class="upload-photo__input"    accept="image/jpeg,image/png,image/webp,image/gif">
                    <label class="upload-photo__label" for="photo">
                        <span class="upload-photo__text" title="Прикрепить можно только один файл">Прикрепить фото</span>
                    </label>
                    <span class="selected_filename" id="selected_filename"><?=$val['photo']?></span>
                </div>
        
                <?php endforeach;?>
                <?php endif;?>
                <?php if(isset($_SESSION['id']) && !empty($_SESSION['id'])):?>
                        <input type="hidden" name="actionFunction" value="editNote">
                    <?php else:?>
                        <input type="hidden" name="actionFunction" value="checkNote">
                    <?php endif;?>
                <div class="input-block">
                    <div class="required-tip">
                        <span class="required-input">*</span>
                        <p>&nbsp; - Обязательное поле</p>  
                    </div>
                    
                    <input type="submit" class="submit-input" value="Отправить данные">
                </div>
            </form>
        </div>
        <div class='links'>
            <?php if(empty($_SESSION['id']) && !isset($_SESSION['id']) ):?>
                <a class="link" href="/notes.php" class="notes-link">Перейти к записям</a>
            <?php else:?>
                <a class="link" href="/note.php?id=<?=$_SESSION['id']?>" class="notes-link">Вернуться к записи № <?=$_SESSION['id']?></a>
            <?php endif;?>
        </div>
    </div>

    <script src="/scripts/script.js"></script>
</body>

</html>