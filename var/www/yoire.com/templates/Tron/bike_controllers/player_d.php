<?php
class player_d{
	public $precision;
	function controller(playerController $c){
		if($this->precision=="") $this->precision=10;
		if($c->direction()==LEFT && $c->collisionDistance(LEFT)<$this->precision){
			$this->precision=$c->collisionDistance(LEFT)/2;
			if($this->precision<5) $this->precision=5;
			//prevent collision
			if($c->collisionDistance(UP)>$c->collisionDistance(DOWN)){
				$c->direction(UP);
			}else{
				$c->direction(DOWN);
			}
			goto done;
		}
		if($c->direction()==RIGHT && $c->collisionDistance(RIGHT)<$this->precision){
			$this->precision=$c->collisionDistance(RIGHT)/2;
			if($this->precision<5) $this->precision=5;
			//prevent collision
			if($c->collisionDistance(UP)>$c->collisionDistance(DOWN)){
				$c->direction(UP);
			}else{
				$c->direction(DOWN);
			}
			goto done;
		}
		if($c->direction()==DOWN && $c->collisionDistance(DOWN)<$this->precision){
			$this->precision=$c->collisionDistance(DOWN)/2;
			if($this->precision<5) $this->precision=5;
			//prevent collision
			if($c->collisionDistance(LEFT)>$c->collisionDistance(RIGHT)){
				$c->direction(LEFT);
			}else{
				$c->direction(RIGHT);
			}
			goto done;
		}
		if($c->direction()==UP && $c->collisionDistance(UP)<$this->precision){
			$this->precision=$c->collisionDistance(UP)/2;
			if($this->precision<5) $this->precision=5;
			//prevent collision
			if($c->collisionDistance(LEFT)>$c->collisionDistance(RIGHT)){
				$c->direction(LEFT);
			}else{
				$c->direction(RIGHT);
			}
			goto done;
		}
		done:
	}
}