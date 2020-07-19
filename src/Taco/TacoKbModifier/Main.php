<?php

namespace Taco\TacoKbModifier;

use pocketmine\Player;
use pocketmine\Server;

use pocketmine\plugin\PluginBase;

use pocketmine\entity\Entity;

use pocketmine\utils\Config;

use pocketmine\event\Listener;
use pocketmine\event\entity\EntityDamageByEntityEvent;

class Main extends PluginBase implements Listener {
    public function onEnable() {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        if (!file_exists($this->getDataFolder() . "config.yml")) {
            $config = new Config($this->getDataFolder() . "config.yml", Config::YAML,[
                "copyright 2020" => "Taco",
                "Knockback" => 0.5,
                ]);
    }
}
    public function onKnockback(EntityDamageByEntityEvent $event) {
        if($event instanceof EntityDamageByEntityEvent){
            if($event->getEntity() instanceof Player && $event->getDamager() instanceof Player) {
                $config = new Config($this->getDataFolder() . "config.yml", Config::YAML);
                $kb = $this->getConfig()->get($config->get("Knockback"));
                $event->setKnockBack($kb);
            }
        }
    }
}
