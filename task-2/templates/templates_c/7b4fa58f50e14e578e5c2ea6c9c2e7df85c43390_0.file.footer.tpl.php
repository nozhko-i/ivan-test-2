<?php /* Smarty version 3.1.24, created on 2015-07-19 18:04:08
         compiled from "templates/templates/footer.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:660555abbc68a3cb23_27435606%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7b4fa58f50e14e578e5c2ea6c9c2e7df85c43390' => 
    array (
      0 => 'templates/templates/footer.tpl',
      1 => 1437318238,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '660555abbc68a3cb23_27435606',
  'variables' => 
  array (
    'date_y' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_55abbc68a40837_72263153',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_55abbc68a40837_72263153')) {
function content_55abbc68a40837_72263153 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '660555abbc68a3cb23_27435606';
?>
<footer>
    <div class="container">
        <div class="copyright">
            &copy; <?php echo $_smarty_tpl->tpl_vars['date_y']->value;?>
 Ivan Nozhka
        </div>
    </div>
</footer>

<?php echo '<script'; ?>
 src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="../../assets/fotorama/fotorama.js"><?php echo '</script'; ?>
>

</body>
</html><?php }
}
?>