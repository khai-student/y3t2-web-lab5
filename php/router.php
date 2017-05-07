<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 11.04.2017
 * Time: 21:58
 */
spl_autoload_register(function ($class_name) {
    include '../classes/' . $class_name . '.php';
});

function home()
{
    header("Location: /index.php");
    die();
}

$utilities = new Utilities();
//

$action = $utilities->GetParam('action', null);
$model = $utilities->GetParam('model', null);

switch ($action)
{
    case 'show':
        $action = "Show";
        break;
    default:
        $action = null;
        break;
}

switch ($model)
{
    case "section":
        $section_name = $utilities->GetParam('section', null);
        switch ($section_name) 
        {
            case null:
                (new Debug)->Error("Section name is not passed.");
                home();
                break;
            default:
                header('Location: ../body-page.php?r=controllers/sectionController.php&data='.$section_name.'');
                die();
                break;
        }
        break;
    default:
        home();
        break;
}

