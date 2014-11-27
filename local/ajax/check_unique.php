<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php") ?>
<?
if ($_REQUEST['login'] && $_REQUEST['email']) {
    $response = array();

    $filter = array(
        'LOGIN' => $_REQUEST['login']
    );
    $rsUsers = CUser::GetList(($by = "personal_country"), ($order = "desc"), $filter)->GetNext();

    if ($rsUsers['ID']) {
        $response['errors']['login'] = 1;
    }

    $emUsers = CUser::GetList(
        ($by = "personal_country"),
        ($order = "desc"),
        array('EMAIL' => $_REQUEST['email'])
    )->GetNext();
    if ($emUsers['ID']) {
        $response['errors']['email'] = 1;
    }

    if(!$response['errors']){
        $response['success'] = 1;
    }

    echo json_encode($response);
}
?>