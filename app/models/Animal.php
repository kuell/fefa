<?php

/**
 *
 */
class Animal extends \Eloquent {
	protected $connection = 'pgsql2';
	protected $table      = "ce.animais";

}