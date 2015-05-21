<div class=footer id=footer>
<div align=center>yoire.com - A place to have fun and learn - Un lugar para divertirse y aprender</div>
</div>
<?php if(Session::logged() && Common::getString("mo")=="" && !preg_match("/challenges/",$_SERVER["SCRIPT_NAME"])){?>
<div class=pi><a href=?mo=Members>&Pi;</a></div>
<?php }?>
<script>
<?php if(Common::getString("mo")=="Hacker!" || Common::getString("mo")=="Canvas"){?>
	disableF();
<?php }?>
if(!window.top.location.href.match(/challenges/)){
	if(window.self.location!=window.top.location || "<?=Common::getString("mo")?>"=="") disableHF();
}
function disableHF(){disableH();disableF();}
function disableH() {document.getElementById("header").style.visibility='hidden';}
function disableF() {document.getElementById("footer").style.visibility='hidden';}
</script>
</body>
</html>