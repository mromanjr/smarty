<?php /* Smarty version Smarty 3.1.4, created on 2013-03-18 20:12:36
         compiled from "application/views/templates/conteudo.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2916751477414454e40-90138393%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dd14045530feef5a36df1662e2a5bb1145858d23' => 
    array (
      0 => 'application/views/templates/conteudo.tpl',
      1 => 1363637555,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2916751477414454e40-90138393',
  'function' => 
  array (
  ),
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_514774144b169',
  'variables' => 
  array (
    'pagina' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_514774144b169')) {function content_514774144b169($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>"Example Smarty Page",'name'=>($_smarty_tpl->tpl_vars['Name']->value)), 0);?>

	<?php echo $_smarty_tpl->tpl_vars['pagina']->value;?>

        <br>        <br>
        <br>
        <br>

<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>"Example Smarty Page",'name'=>($_smarty_tpl->tpl_vars['Name']->value)), 0);?>
<?php }} ?>