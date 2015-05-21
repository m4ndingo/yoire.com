<?php
class player_a{
	function controller(playerController $c){
		if($c->direction()==UP && $c->getY()<10){
			if(rand(0,1)==0) $c->direction(LEFT);
				else $c->direction(RIGHT);
			goto done;
		}
		if($c->direction()==DOWN && MAX_Y-$c->getY()<10){
			if(rand(0,1)==0) $c->direction(LEFT);
				else $c->direction(RIGHT);
			goto done;
		}
		if($c->direction()==LEFT && $c->getX()<10){
			if(rand(0,1)==0) $c->direction(UP);
				else $c->direction(DOWN);
			goto done;
		}
		if($c->direction()==RIGHT && MAX_X-$c->getX()<10){
			if(rand(0,1)==0) $c->direction(UP);
				else $c->direction(DOWN);
		}
		done:
	}
}