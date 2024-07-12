<?php

namespace psycofeu\vanillaEconomy\Commandes;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\permission\DefaultPermissions;
use pocketmine\player\Player;
use pocketmine\Server;
use psycofeu\vanillaEconomy\API\vanillaAPI;
use psycofeu\vanillaEconomy\Main;

class pay extends Command
{
    public function __construct()
    {
        parent::__construct("pay", Main::getInstance()->getConfigFile("config")->get("pay_description"), "/pay");
        $this->setPermission(DefaultPermissions::ROOT_USER);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if (!$sender instanceof Player) return;
        if (empty($args[0])){
            $sender->sendMessage(Main::getInstance()->getConfigFile("config")->get("missing_player"));
            return;
        }
        if (empty($args[1]) or !is_numeric($args[1])){
            $sender->sendMessage(Main::getInstance()->getConfigFile("config")->get("missing_int"));
            return;
        }
        $money = $args[1];
        $arg0 = $args[0];
        if ($sender->getName() === $arg0){
            $sender->sendMessage(Main::getInstance()->getConfigFile("config")->get("no_pay_youself"));
            return;
        }
        $arg0 = Server::getInstance()->getPlayerExact($arg0);
        if ($arg0 instanceof Player){
            $player = $arg0;
        }else{
            $sender->sendMessage(str_replace("{player}", $arg0, Main::getInstance()->getConfigFile("config")->get("player_dont_exist")));
            return;
        }
        vanillaAPI::getInstance()->pay($sender, $player, $money);
    }
}