<?php

namespace psycofeu\vanillaEconomy\Commandes;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\permission\DefaultPermissions;
use pocketmine\player\Player;
use psycofeu\vanillaEconomy\Main;

class topmoney extends Command
{
    public function __construct()
    {
        parent::__construct("topmoney", Main::getInstance()->getConfigFile("config")->get("topmoney_description"), "/topmoney", ["topbal"]);
        $this->setPermission(DefaultPermissions::ROOT_USER);
    }
    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if (!$sender instanceof Player) return;
        $moneys = Main::getInstance()->getConfigFile("money")->getAll();
        $config = Main::getInstance()->getConfigFile("config");
        $message = $config->get("topmoney_base") . "\n";
        arsort($moneys);
        $i = 1;
        foreach ($moneys as $player => $money) {
            if ($i > $config->get("topmoney_count")) {
                break;
            }
            $message .= str_replace(array("{top}", "{player}", "{money}", "{money_symbole}"), array($i, $player, $money, $config->get("money_symbole")), $config->get("topmoney_line")) . "\n";
            $i++;
        }
        $sender->sendMessage($message . $config->get("topmoney_base"));
    }
}