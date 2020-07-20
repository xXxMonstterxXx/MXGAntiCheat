<?php

namespace MXGLatoya;

// Plugin
use pocketmine\plugin\PluginBase;

// Events

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\event\player\PlayerToggleFlightEvent;
use pocketmine\event\player\PlayerGameModeChangeEvent;
use pocketmine\event\server\DataPacketReceiveEvent;

// Default

use pocketmine\Server;
use pocketmine\Player;

// Command

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

// Utils

use pocketmine\utils\Config;
use pocketmine\utils\TextFormat as Color;



class AntiCheat extends PluginBase implements Listener {
	
	
	
	const FUNCTION_ERROR = "§cError §7|§r ";
	const CLIENT_PREFIX = "§bMXGAnti§6Cheat §7|§r ";
	
	
	
	public function onEnable(){

    $this->getLogger()->info("§6The AntiCheat by MXGLatoya started");
    
    $this->getServer()->getPluginManager()->registerEvents($this, $this);
   
     
    }
    
    
    
     
     // Check if use normal Original MCBE or come from a Proxy Server or use Mods
		public function onReceive(DataPacketReceiveEvent $event) {
         $player = $event->getPlayer();
        $packet = $event->getPacket();
        if ($packet instanceof LoginPacket) {
            if ($packet->serverAddress === "fallenkitpvp.mcpe.lol") {
                $player->kick(Color::RED . "Kicked by MXGAntiCheat.\n" . Color::YELLOW . "Reason: " . Color::WHITE . "Proxy\n" . Color::AQUA . "Plugin made by: " . Color::YELLOW . "MXGLatoya#1616", false);
            }
            if ($packet->clientId === 0) {
                $player->kick(Color::RED . "Kicked by MXGAntiCheat.\n" . Color::YELLOW . "Reason: " . Color::WHITE . "ModClient\n" . Color::AQUA . "Plugin made by: " . Color::YELLOW . "MXGLatoya", false);
            }
        }
       }
    
    // FLY-HACK Check
   public function onFlying(PlayerToggleFlightEvent $event) {
    
      $player = $event->getPlayer();
   
     if ($event->isFlying()) {
     	
     	if ($player->hasPermission("anticheat.bypass.fly")) {
     	   
  
            
         } else {
         	
           $player->kick(Color::RED . "Kicked by MXGAntiCheat.\n" . Color::YELLOW . "Reason: " . Color::WHITE . "Fly\n" . Color::AQUA . "Plugin made by: " . Color::YELLOW . "MXGLatoya", false);
           
           
         
         }
     }
   }
   
   // Check Player have a high Ping
   
   public function onMove(PlayerMoveEvent $event) {
   
     $player = $event->getPlayer();

        if ($player->getPing() > 500) {
   	
      
      
        	    $player->kick(Color::RED . "Kicked by MXGAntiCheat.\n" . Color::YELLOW . "Reason: " . Color::WHITE . "High Ping\n" . Color::AQUA . "Plugin made by: " . Color::YELLOW . "MXGLatoya", false);
                
            
         



    }
  
  }
  
   public function onGameModeChange(PlayerGameModeChangeEvent $event) {
    	
    	$player = $event->getPlayer();
        $gamemode = $event->getNewGameMode();
        if ($player->hasPermission("anticheat.bypass.gamemode")) {
        	
        } else {
        	
        	if ($gamemode === 1) {
        	
        	    $player->kick(
                Color::RED . "Kicked by MXGAntiCheat.\n" .
                Color::YELLOW . "Reason: " . Color::WHITE . "Gamemode Change\n" .
                Color::AQUA . "Plugin made by: " . Color::YELLOW . "MXGLatoya", false
                );
                
            }
        	
        }
    	
    }
    



    }
