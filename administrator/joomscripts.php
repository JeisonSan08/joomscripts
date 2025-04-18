<?php
/*------------------------------------------------------------------------
# mod_joomscripts - JoomScripts
# ------------------------------------------------------------------------
# Jeison Ferreira, baseado no trabalho original de Iacopo Guarneri
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Website: http://blog.websagencia.com.br
-------------------------------------------------------------------------*/

// no direct access
defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\Toolbar\ToolbarHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\Editor\Editor;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;

ToolbarHelper::title("JoomScripts");

// Se for tarefa de inserção, inclui o arquivo insert.php
if (@$_GET['task'] === "insert") {
    include("components/com_joomscripts/insert.php");
}

if (@$_GET['task'] !== "insert") :
?>

<script src="components/com_joomscripts/jquery.js"></script>
<script type="text/javascript">
function str_replace(str, str2, str3) {
    return str3.split(str).join(str2);
}

function submitbutton() {
    if (!window.Joomla || !window.Joomla.editors || !window.Joomla.editors.instances['codice']) {
        alert('Editor ainda não carregado. Tente novamente em alguns segundos.');
        return;
    }

    const editor = window.Joomla.editors.instances['codice'];

    if (typeof editor.getValue !== 'function') {
        alert('Método getValue indisponível. Verifique a configuração do editor.');
        return;
    }

    let txt = editor.getValue();
    txt = str_replace("&", "[e_commerciale]", txt);
    txt = str_replace("+", "[piu]", txt);

    $.ajax({
        type: "POST",
        url: "index.php?option=com_joomscripts&task=insert",
        data: "txt=" + encodeURIComponent(txt) + "&title=" + encodeURIComponent(document.getElementById('nome_file').value),
        success: function(response) {
            location.reload();
        },
        error: function(xhr, status, error) {
            alert('Erro ao salvar: ' + error);
        }
    });
}

jQuery(document).ready(function($) {
    $('button[onclick="submitbutton()"]').on('click', submitbutton);
});
</script>

<h2>Arquivos Criados</h2>
<div style="border-top:5px dotted #555;"></div>
<div style="width:100%; max-height:150px; overflow:auto; padding:15px 0;">
<?php
function elencafiles($dirname) {
    $arrayfiles = array();
    if (file_exists($dirname)) {
        $handle = opendir($dirname);
        while (false !== ($file = readdir($handle))) {
            if (is_file($dirname . $file)) {
                $arrayfiles[] = $file;
            }
        }
        closedir($handle);
    }
    sort($arrayfiles);
    return $arrayfiles;
}

$arrayfile = elencafiles("components/com_joomscripts/source/");

foreach ($arrayfile as $file) {
    if ($file !== "index.html") {
        echo "<div style='float:left; width:20%; margin-right:4%; height:20px; overflow:hidden;'>
                <a href='index.php?option=com_joomscripts&file=" . htmlspecialchars($file) . "'>" . htmlspecialchars($file) . "</a>
              </div>";
    }
}
?>
</div>
<div style="border-top:5px dotted #555; margin-bottom:50px;"></div>

<?php
$contents = "Insert code";
$contents_name = "file_name.php";

if (@$_GET['file'] !== "") {
    $filename = "components/com_joomscripts/source/" . basename($_GET['file']);
    if (file_exists($filename)) {
        $handle = fopen($filename, "r");
        $contents = stripslashes(fread($handle, filesize($filename)));
        $contents_name = $_GET['file'];
        fclose($handle);
    }
}

echo 'administrator/components/com_joomscripts/source/<input type="text" id="nome_file" value="' . htmlspecialchars($contents_name) . '">';

// 🔧 Usa o editor padrão (CodeMirror ou outro que esteja habilitado)
$editor = Editor::getInstance('codemirror');
echo "<div style='border:1px solid #000;'>" . $editor->display('codice', $contents, '100%', '768', '40', '5', false) . "</div>";
echo HTMLHelper::_('form.token');
?>

<button type="button" onclick="submitbutton()"><?php echo Text::_('Save'); ?></button>

<?php endif; ?>
