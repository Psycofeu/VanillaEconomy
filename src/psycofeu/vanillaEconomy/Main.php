<?php

namespace psycofeu\vanillaEconomy;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerExhaustEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\plugin\PluginBase;
use pocketmine\scheduler\ClosureTask;
use pocketmine\Server;
use pocketmine\utils\Config;
use pocketmine\utils\SingletonTrait;
use psycofeu\vanillaEconomy\API\vanillaAPI;
use psycofeu\vanillaEconomy\Commandes\givemoney;
use psycofeu\vanillaEconomy\Commandes\mymoney;
use psycofeu\vanillaEconomy\Commandes\pay;
use psycofeu\vanillaEconomy\Commandes\seemoney;
use psycofeu\vanillaEconomy\Commandes\takemoney;
use psycofeu\vanillaEconomy\Commandes\topmoney;

class Main extends PluginBase implements Listener
{
    use SingletonTrait;
    protected function onLoad(): void
    {
        self::setInstance($this);
    }

    protected function onEnable(): void
    {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getLogger()->notice("Plugin enable");
        $this->saveDefaultConfig();
        $this->saveResource("config");
        $this->getServer()->getCommandMap()->registerAll("", [
            new givemoney(),
            new mymoney(),
            new pay(),
            new seemoney(),
            new takemoney(),
            new topmoney()
        ]);
    }

    public function getConfigFile(string $file): Config
    {
        return new Config($this->getDataFolder() . $file . ".yml", Config::YAML);
    }

    public function onJoin(PlayerJoinEvent $event) : void
    {
        $dataPlayer = $this->getConfigFile("money");
        $player = $event->getPlayer();
        if (!$dataPlayer->exists(strtolower($player->getName()))){
            vanillaAPI::getInstance()->setMoney($player, $this->getConfigFile("config")->get("default_money") ?? 0);
        }
    }

}