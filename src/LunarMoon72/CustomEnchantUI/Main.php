<?php

namespace LunarMoon72\CustomEnchantUI;

use pocketmine\plugin\PluginBase;

use pocketmine\command\{
	Command, CommandSender, ConsoleCommandSender
};
use pocketmine\Player;
use pocketmine\Server;

class Main extends PluginBase
{
	public function onEnabled() : void {

	}
	public function onCommand(CommandSender $sender, Command $cmd, String $label, Array $args) : bool 
  {

    switch($cmd->getName())
    {
      case "ceedit":
       if($sender instanceof Player)
       {
        $this->ceui($sender);
       } else {
        $this->getLogger()->info("You cannot do this in Console!");
        return true;

       }
    }
  return true;
  }
  public function ceui($player){
  	$form = $this->getServer()->getPluginManager()->getPlugin("FormAPI")->createCustomForm(function(Player $player, int $data = null){
        if($data === null){

            return true;
        }
        switch($data){
            case 0:
               $player->armor($player);
            break;

            case 1:
               $player->weapon($player);
            break;
        }
    });
  	$form->setTitle("§cSelect a category");
  	$form->addButton("§4Weapons");
  	$form->addButton("§bTools");
  	$form->sendToPlayer();
  	return $form;
  }
  public function armor($player){
    $console = new ConsoleCommandSender();
  	$form = $this->getServer()->getPluginManager()->getPlugin("FormAPI")->createCustomForm(function(Player $player, int $data = null){
       if($data === null){
       	return true;
       }
       switch($data){
       	case 0:
       	    $this->getServer()->dispatchCommand($console, "ce enchant armored " . $data[0] . " " . $player);
        break;

        case 1:
            $this->getServer()->dispatchCommand($console, "ce enchant obsidiansheild " . $data[1] . " " . $player);
        break;

        case 2:
            $this->getServer()->dispatchCommand($console, "ce enchant springs " . $data[2] . " " . $player);
        break;

        case 3:
            $this->getServer()->dispatchCommand($console, "ce enchant gears " . $data[3] . " " . $player);
        break;
       }
  	});
  	$form->setTitle("Choose an enchant");
    $form->addSlider("Armored", 0, 5);
    $form->addSlider("Obsidian Sheild", 0, 5);
    $form->addSlider("Springs", 0, 3);
    $form->addSlider("Gears", 0, 3);
    $form->sendToPlayer();
    return $form;
  }
  public function weapon($player)
  {
    $console = new ConsoleCommandSender();
    $form = $this->getServer()->getPluginManager()->getPlugin("FormAPI")->createCustomForm(function(Player $player, int $data = null){
        if($data === null){
            return true;
        }
        switch($data){
            case 0:
                $this->getServer()->dispatchCommand($console, "ce enchant deathbringer" . $data[0] . " " . $player);
            break;

            case 1:
                $this->getServer()->dispatchCommand($console, "ce enchant aerial " . $data[1] . " " . $player);
            break;

            case 2:
                $this->getServer()->dispatchCommand($console, "ce enchant lifesteal " . $data[2] . " " . $player);

        }

    });
    $form->setTitle("Select an Enchant");
    $form->addSlider("Deathbringer", 0, 10);
    $form->addSlider("Aerial", 0, 10);
    $form->addSlider("LifeSteal", 0, 10);
    $form->sendToPlayer();
    return $form;
  }

}
