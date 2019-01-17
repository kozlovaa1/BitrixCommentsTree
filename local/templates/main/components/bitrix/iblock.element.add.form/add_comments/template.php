<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(false);

if (!empty($arResult["ERRORS"])):?>
    <?
    ShowError(implode("<br />", $arResult["ERRORS"])) ?>
<?endif;
if (strlen($arResult["MESSAGE"]) > 0):?>
    <? ShowNote($arResult["MESSAGE"]) ?>
<? endif ?>
<form name="iblock_add" action="<?= POST_FORM_ACTION_URI ?>" method="post" enctype="multipart/form-data">
    <?= bitrix_sessid_post() ?>
    <div class="form-group">
        <label for="inputName">Имя</label>
        <input type="text" name="PROPERTY[NAME][0]"
               class="form-control" id="inputName" aria-describedby="nameHelp"
               placeholder="Введите имя">
    </div>
    <div class="form-group">
        <label for="commentText">Напишите комментарий</label>
        <textarea class="form-control" id="commentText" rows="3"
                  name="PROPERTY[PREVIEW_TEXT][0]"></textarea>
    </div>
    <input type="hidden" name="PROPERTY[1][0]" value="<?= $arParams['CUR_PAGE'] ?>">
    <input type="hidden" name="PROPERTY[2][0]" id="parent_comment" value="">
    <? if ($arParams["USE_CAPTCHA"] == "Y" && $arParams["ID"] <= 0): ?>
        <div class="form-group row">
            <input type="hidden" name="captcha_sid" value="<?= $arResult["CAPTCHA_CODE"] ?>"/>
            <label for="captcha" class="col-sm-2 col-form-label">Введите код с картинки<span
                        class="starrequired">*</span>:</label>
                <div class="col-sm-2"><input type="text" id="captcha" name="captcha_word" maxlength="50" value=""
                                              class="form-control"></div>
                <div class="col-sm-3"><img class="col-sm-6"
                                            src="/bitrix/tools/captcha.php?captcha_sid=<?= $arResult["CAPTCHA_CODE"] ?>"
                                            width="180" height="40" alt="CAPTCHA"/></div>

        </div>
    <? endif ?>
    <input type="submit" name="iblock_submit" value="Отправить<? //= GetMessage("IBLOCK_FORM_SUBMIT") ?>"
           class="btn btn-primary"/>
    <? if (strlen($arParams["LIST_URL"]) > 0): ?>
        <input type="submit" name="iblock_apply" value="Принять<? //= GetMessage("IBLOCK_FORM_APPLY") ?>"/>
        <input
                type="button"
                name="iblock_cancel"
                value="Отменить<? //= GetMessage('IBLOCK_FORM_CANCEL'); ?>"
                onclick="location.href='<? echo CUtil::JSEscape($arParams["LIST_URL"]) ?>';"
                class="btn"
        >
    <? endif ?>
</form>

<script type='text/javascript'>
    document.onclick = function (e) {
        if (e.target.matches('.reply-button')) {
            document.querySelector('#parent_comment').value = e.target.dataset.commentid;
        }
    };
</script>
