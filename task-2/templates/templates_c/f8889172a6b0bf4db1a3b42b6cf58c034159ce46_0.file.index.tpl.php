<?php /* Smarty version 3.1.24, created on 2015-07-19 18:11:32
         compiled from "templates/templates/index.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:1550855abbe2485fdc6_14366467%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f8889172a6b0bf4db1a3b42b6cf58c034159ce46' => 
    array (
      0 => 'templates/templates/index.tpl',
      1 => 1437318691,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1550855abbe2485fdc6_14366467',
  'variables' => 
  array (
    'error' => 0,
    'error_msg' => 0,
    'wm' => 0,
    'images' => 0,
    'image' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_55abbe24899143_66720021',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_55abbe24899143_66720021')) {
function content_55abbe24899143_66720021 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '1550855abbe2485fdc6_14366467';
?>

<?php echo $_smarty_tpl->getSubTemplate ('header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>


<div class="main-content">
    <div class="container" role="main">

        <div class="form-wrapper jumbotron">
            <form action="/" enctype="multipart/form-data" id="image-upload" method="post">

                <?php if (isset($_smarty_tpl->tpl_vars['error']->value) && $_smarty_tpl->tpl_vars['error']->value == 'true') {?>
                <div class="alert alert-danger"><?php echo $_smarty_tpl->tpl_vars['error_msg']->value;?>
</div>
                <?php }?>

                <fieldset>
                    <div class="row">
                        <div class="col-lg-3 text-right"><label for="id-wm">Watermark text:<label></div>
                        <div class="col-lg-4"><input type="text" class="form-control" name="wm" id="id-wm" value="<?php echo $_smarty_tpl->tpl_vars['wm']->value;?>
" /></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 text-right"><label for="id-file">Image file:</label></div>
                        <div class="col-lg-4"><input type="file" class="form-control" name="im" id="id-file" /></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 text-right">&nbsp;</div>
                        <div class="col-lg-4"><input type="submit" class="btn btn-success" /></div>
                    </div>
                </fieldset>

            </form>
        </div>

        <div class="fotorama" data-nav="thumbs" data-arrows="true" data-width="100%" data-maxheight="500" data-maxheight="100%">
            <?php
$_from = $_smarty_tpl->tpl_vars['images']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['image'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['image']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['image']->value) {
$_smarty_tpl->tpl_vars['image']->_loop = true;
$foreach_image_Sav = $_smarty_tpl->tpl_vars['image'];
?>
                <img src="assets/img/uploads/<?php echo $_smarty_tpl->tpl_vars['image']->value;?>
" />
            <?php
$_smarty_tpl->tpl_vars['image'] = $foreach_image_Sav;
}
?>
        </div>

    </div>
</div>

<?php echo $_smarty_tpl->getSubTemplate ('footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>


<?php }
}
?>