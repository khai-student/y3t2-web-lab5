<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 11.04.2017 
 * Time: 20:47
 */

spl_autoload_register(function ($class_name) {
    include '../classes/' . $class_name . '.php';
});

$db = new Database();

$sections = $db->Select("SELECT name FROM public.section;");
echo '
<div class="sidebar">
    <a href="index.php" id="logo"><img src="/images/logo.png" alt="logo"></a>
    <ul>
        <li class="selected">
            <a href="php/router.php">Home</a>
        </li>';

if (count($sections) > 0)
{

    foreach ($sections as $section)
    {
        echo '<li>
            <a href="/php/router.php?action=show&model=section&section='.strtolower($section['name']).'">'.$section['name'].'</a>
        </li>';
    }
}

echo '
    </ul>
</div>
';
