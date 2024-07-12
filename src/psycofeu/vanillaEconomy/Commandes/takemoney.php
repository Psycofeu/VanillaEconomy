<?php

namespace psycofeu\vanillaEconomy\Commandes;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\Server;
use psycofeu\vanillaEconomy\API\vanillaAPI;
use psycofeu\vanillaEconomy\Main;

class takemoney extends Command
{
    public function __construct()
    {
        parent::__construct("takemoney", Main::getInstance()->getConfigFile("config")->get("takemoney_description"), "/takemoney", ["removemoney"]);
        $this->setPermission("takemoney.use");
        $this->setPermissionMessage(str_replace("{permission}", "takemoney.use", Main::getInstance()->getConfigFile("config")->get("no_permission")));
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if (!$sender instanceof Player) return;

        if (empty($args[0])){
            $sender->sendMessage(Main::getInstance()->getConfigFile("config")->get("missing_player"));
            return;
        }
        if (empty($args[1] or !is_numeric($args[1]))){
            $sender->sendMessage(Main::getInstance()->getConfigFile("config")->get("missing_int"));
            return;
        }
        $money = $args[1];
        $arg0 = $args[0];
        $args = Server::getInstance()->getPlayerExact($arg0);
        if ($arg0 instanceof Player){
            $player = $arg0;
        }else{
            $args = Server::getInstance()->getPlayerByPrefix($arg0);
            if ($arg0 instanceof Player){
                $player = $arg0;
            }else{
                $sender->sendMessage(Main::getInstance()->getConfigFile("config")->get("player_dont_exist"));
                return;
            }
        }
        $sender->sendMessage(str_replace(["{money}", "{money_symbole}", "{player}"], [$money, Main::getInstance()->getConfigFile("config")->get("money_symbole"), $player->getName()], Main::getInstance()->getConfigFile("config")->get("takemoney_sender_message")));
        $player->sendMessage(str_replace(["{money}", "{money_symbole}"], [$money, Main::getInstance()->getConfigFile("config")->get("money_symbole")], Main::getInstance()->getConfigFile("config")->get("takemoney_taked_player")));
        vanillaAPI::getInstance()->addMoney($player, $money);
    }
}