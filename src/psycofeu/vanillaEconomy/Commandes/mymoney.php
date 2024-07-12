<?php

namespace psycofeu\vanillaEconomy\Commandes;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\lang\Translatable;
use pocketmine\permission\DefaultPermissions;
use pocketmine\player\Player;
use psycofeu\vanillaEconomy\API\vanillaAPI;
use psycofeu\vanillaEconomy\Main;

class mymoney extends Command
{
    public function __construct()
    {
        parent::__construct("mymoney", Main::getInstance()->getConfigFile("config")->get("mymoney_description"), "/mymoney", ["bal"]);
        $this->setPermission(DefaultPermissions::ROOT_USER);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if (!$sender instanceof Player) return;
        $sender->sendMessage(str_replace(array("{money}", "{money_symbole}"), array(vanillaAPI::getInstance()->seeMoney($sender), Main::getInstance()->getConfigFile("config")->get("money_symbole")), Main::getInstance()->getConfigFile("config")->get("mymoney_message")));
    }
}