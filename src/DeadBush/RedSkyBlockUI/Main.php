<?php

namespace DeadBush\RedSkyBlockUI;

use pocketmine\Player;
use pocketmine\Server;
use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;

class Main extends PluginBase {
	public function onEnable(){
		
	}
	
	public function onCommand(CommandSender $sender, Command $cmd, String $label, Array $args): bool {
		
		switch($cmd->getName()){
			case "sb":
			 if($sender instanceof Player){
				 $this->sb($sender);
			 }
		}
		
	return true;
	}
	
	public function sb($player){
		$form = $this->getServer()->getPluginManager()->getPlugin("FormAPI")->createSimpleForm(function (Player $player, int $data = null){
			if($data === null){
				return true;
			}
		switch($data){
			case 0:
			    $this->getServer()->dispatchCommand($player, "is create");
			break;
			
			case 1:
			    $this->getServer()->dispatchCommand($player, "is tp");
			break;
			
			case 2:
			    $this->manageplayer($player);
			break;
			
			case 3:
			    $this->manageisland($player);
			break;
			
			case 4:
			    $this->getServer()->dispatchCommand($player, "is fly");
			break;
			
			case 5:
			    $this->info($player);
			break;

			case 6:
			    $this->getServer()->dispatchCommand($player, "is members");
			break;

			case 7:
			    $this->getServer()->dispatchCommand($player, "is rank");
			break;

			case 8:
			    $this->getServer()->dispatchCommand($player, "is top");
			break;

			case 9:
			    $this->visit($player);
			break;
		}
		});
		$form->setTitle("§l§3Sky§fBlock §aUI");
		$form->addButton("§lCreate Island");
		$form->addButton("§lTeleport");
		$form->addButton("§lManage Players");
		$form->addButton("§lManage Island");
		$form->addButton("§lFly");
		$form->addButton("§lIs Info");
		$form->addButton("§lIs Members");
		$form->addButton("§lIs Rank");
		$form->addButton("§lIs Top");
		$form->addButton("§lIs Visit");
		$form->sendToPlayer($player);
		return $form;
	}
	
	public function manageplayer($player){
		$form = $this->getServer()->getPluginManager()->getPlugin("FormAPI")->createSimpleForm(function (Player $player, array $data = null){
			if($data === null){
				return true;
			}
		switch($data){
			case 0:
			    $this->add($player);
			break;

			case 1:
			    $this->kick($player);
			break;

			case 2:
			    $this->ban($player);
			break;

			case 3:
			    $this->unban($player);
			break;
		}
		});
		$form->setTitle("§l§bPlayer Management");
		$form->addButton("Add Player");
		$form->addButton("Kick Player");
		$form->addButton("Ban Player");
		$form->addButton("Unban Player");
		$form->sendToPlayer($player);
		return $form;
	}
	
	public function add($player){
		$form = $this->getServer()->getPluginManager()->getPlugin("FormAPI")->createCustomForm(function (Player $player, array $data = null){
			if($data === null){
				return true;
			}
			$this->getServer()->dispatchCommand($player, "is add " . $data[0]);
        });
		$form->setTitle("§l§3Add Player");
		$form->addInput("§eEnter The Player Name You Want To Add");
		$form->sendToPlayer($player);
		return $form;
	}
	
	public function kick($player){
		$form = $this->getServer()->getPluginManager()->getPlugin("FormAPI")->createCustomForm(function (Player $player, array $data = null){
			if($data === null){
				return true;
			}
			$this->getServer()->dispatchCommand($player, "is kick " . $data[0]);
		});
		$form->setTitle("§l§3Kick Player");
		$form->addInput("§eEnter The Player Name To Kick");
		$form->sendToPlayer($player);
		return $form;
	}
	
	public function ban($player){
		$form = $this->getServer()->getPluginManager()->getPlugin("FormAPI")->createCustomForm(function (Player $player, array $data = null){
			if($data === null){
				return true;
			}
			$this->getServer()->dispatchCommand($player, "is ban " . $data[0]);
		});
		$form->setTitle("§l§3Ban Player");
		$form->addInput("§eEnter The Player Name To Ban");
		$form->sendToPlayer($player);
		return $form;
	}

	public function unban($player){
		$form = $this->getServer()->getPluginManager()->getPlugin("FormAPI")->createCustomForm(function (Player $player, array $data = null){
			if($data === null){
				return true;
			}
			$this->getServer()->dispatchCommand($player, "is unban " . $data[0]);
		});
		$form->setTitle("§l§3Unban Player");
		$form->addInput("§eEnter The Player Name To Unban");
		$form->sendToPlayer($player);
		return $form;
	}

	public function manageisland($player){
		$form = $this->getServer()->getPluginManager()->getPlugin("FormAPI")->createSimpleForm(function (Player $player, array $data = null){
			if($data === null){
				return true;
			}
		switch($data){
			case 0:
			    $this->lock($player);
			break;

			case 1:
			    $this->name($player);
			break;

			case 2:
			    $this->getServer()->dispatchCommand($player, "is setspawn");
			break;

			case 3:
			    $this->getServer()->dispatchCommand($player, "is reset");
			break;
		}
		});
		$form->setTitle("§l§bIsland Management");
		$form->addButton("Lock/Unlock");
		$form->addButton("Is Rename");
		$form->addButton("Is Spawn");
		$form->addButton("Is Reset");
		$form->sendToPlayer($player);
		return $form;
	}
	
	public function lock($player){
		$form = $this->getServer()->getPluginManager()->getPlugin("FormAPI")->createSimpleForm(function (Player $player, array $data = null){
			if($data === null){
				return true;
			}
		switch($data){
			case 0:
			    $this->getServer()->dispatchCommand($player, "is lock");
			break;

			case 1:
			    $this->getServer()->dispatchCommand($player, "is unlock");
		}
		});
		$form->setTitle("§l§3Lock/Unlock");
		$form->addButton("Is Lock");
		$form->addButton("Is Unlock");
		$form->sendToPlayer($player);
		return $form;
	}
	
	public function name($player){
		$form = $this->getServer()->getPluginManager()->getPlugin("FormAPI")->createCustomForm(function (Player $player, array $data = null){
			if($data === null){
				return true;
			}
			$this->getServer()->dispatchCommand($player, "is name " . $data[0]);
		});
		$form->setTitle("§l§3Rename Island");
		$form->addInput("§eEnter The NameYou Want To Rename To");
		$form->sendToPlayer($player);
		return $form;
	}

	public function info($player){
		$form = $this->getServer()->getPluginManager()->getPlugin("FormAPI")->createCustomForm(function (Player $player, array $data = null){
			if($data === null){
				return true;
			}
			$this->getServer()->dispatchCommand($player, "is info " . $data[0]);
		});
		$form->setTitle("§l§3Island Info");
		$form->addInput("§eEnter The Player Name To Get The Island Info");
		$form->sendToPlayer($player);
		return $form;
	}

	public function visit($player){
		$form = $this->getServer()->getPluginManager()->getPlugin("FormAPI")->createCustomForm(function (Player $player, array $data = null){
			if($data === null){
				return true;
			}
			$this->getServer()->dispatchCommand($player, "is visit " . $data[0]);
		});
		$form->setTitle("§l§3Visit Island");
		$form->addInput("§eEnter The Player Name You Want To Visit");
		$form->sendToPlayer($player);
		return $form;
	}

}