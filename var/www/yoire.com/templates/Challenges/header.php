<div class=chall_header>
<h3><a href="<?=$vars["dir"]?>"><?=$vars["dir"]?></a>/<?=$vars["file"]?> <div class=small></h3>
<h4>Clasificación / Classification: <?=Challenges::dificulty()?> [ <?=(Challenges::solved()?"Resuelto / Solved ".smiley::build("q:^D"):"Sin Resolver / Unsolved");?> ]</h4>
</div>
