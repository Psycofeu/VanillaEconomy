<?php

namespace psycofeu\vanillaEconomy\Commandes;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\permission\DefaultPermissions;
use pocketmine\player\Player;
use pocketmine\Server;
use psycofeu\vanillaEconomy\API\vanillaAPI;
use psycofeu\vanillaEconomy\Main;

class seemoney extends Command
{
    public function __construct()
    {
        parent::__construct("seemoney", Main::getInstance()->getConfigFile("config")->get("seemoney_description"), "/seemoney", ["seebal"]);
        $this->setPermission(DefaultPermissions::ROOT_USER);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if (!$sender instanceof Player) return;

        if (empty($args[0])){
            $sender->sendMessage(Main::getInstance()->getConfigFile("config")->get(("missing_player")));
            return;
        }
        $arg0 = $args[0];
        $args = Server::getInstance()->getPlayerExact($arg0);
        if ($args instanceof Player){
            $player = $args;
        }else{
            $args = Server::getInstance()->getPlayerByPrefix($arg0);
            if ($args instanceof Player){
                $player = $args;
            }else{
                $sender->sendMessage(Main::getInstance()->getConfigFile("config")->get("player_dont_exist"));
                return;
            }
        }

        $sender->sendMessage(str_replace(array("{player}", "{money}", "{money_symbole}"), array($arg0->getName(), vanillaAPI::getInstance()->seeMoney($arg0), Main::getInstance()->getConfigFile("config")->get("money_symbole")), Main::getInstance()->getConfigFile("config")->get("seemoney_message")));
    }
}