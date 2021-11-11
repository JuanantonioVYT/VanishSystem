<?php

namespace JuanantonioVYT\VanishSystem;

use pocketmine\Player;
use pocketmine\Server;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\event\Listener;

use pocketmine\plugin\PluginBase;

use pocketmine\utils\TextFormat as TF;

class Main extends PluginBase {

  public $prefix = TF::GREEN . "[VanishSystem] ";
  public $about = TF::GREEN . "[AboutPlugin] ";
  public $error = TF::RED . "[Error] ";
  
  public function onEnable() {
    $this->getLogger()->info("Vanish Enabled successfully, plugin made by JuanantonioVYT");
  }
  
  public function onDisable() {
    
  }
  
  public function onCommand(CommandSender $sender, Command $cmd, String $label, Array $args) : bool {
    if($sender instanceof Player) {
      
      $player = $sender->getPlayer();
      
      if($label === "vanish") {
        if($sender->isOp()) {
          foreach($this->getServer()->getOnlinePlayers() as $online){
            $online->hidePlayer($player);
          }

          $sender->sendMessage($this->prefix . $this->getConfig()->get("msg-vanish"));
        } else {
          $sender->sendMessage(TF::RED . $this->error . "You not have permissions to use command");
        }
      }
        
      if($label === "unvanish") {
        if($sender->isOp()) {
          foreach($this->getServer()->getOnlinePlayers() as $online){
            $online->showPlayer($player);
          }

          $sender->sendMessage($this->prefix . $this->getConfig()->get("msg-unvanish"));
        } else {
          $sender->sendMessage(TF::RED . $this->error . "You not have permissions to use command");
        }
      }
       
      if($label === "vanishabout") {
        $sender->sendMessage(TF::RED . $this->about . TF::YELLOW . "Plugin made by JuanantonioVYT Version 1.0");
      }
    } else {
      $sender->sendMessage($this->error . TF::RED. "Only players can use this command.");
      return true;
    }
    return false;
  }
}
