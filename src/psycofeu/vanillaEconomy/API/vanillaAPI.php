<?php

namespace psycofeu\vanillaEconomy\API;

use pocketmine\player\Player;
use pocketmine\utils\SingletonTrait;
use psycofeu\vanillaEconomy\Main;

class vanillaAPI
{
    use SingletonTrait;
    public function setMoney(Player $player, int $money): void
    {
        $config = Main::getInstance()->getConfigFile("money");
        $config->set(strtolower($player->getName()), $money);
        $config->save();
    }
    public function addMoney(Player $player, int $money): void
    {
        $config = Main::getInstance()->getConfigFile("money");
        $config->set(strtolower($player->getName()), $config->get(strtolower($player->getName()))+$money);
        $config->save();
    }
    public function removeMoney(Player $player, int $money): void
    {
        $config = Main::getInstance()->getConfigFile("money");
        $config->set(strtolower($player->getName()), $config->get(strtolower($player->getName()))-$money);
        $config->save();
    }
    public function seeMoney(Player $player): int
    {
        return Main::getInstance()->getConfigFile("money")->get(strtolower($player->getName()));
    }
    public function pay(Player $payer, Player $recever, int $money)
    {
        $min = Main::getInstance()->getConfigFile("config")->get("pay_min");
        $max = Main::getInstance()->getConfigFile("config")->get("pay_max");
        if ($money < 1){
            $payer->sendMessage(Main::getInstance()->getConfigFile("config")->get("minimum_1"));
            return;
        }
        if ($money < $min){
            $payer->sendMessage(str_replace(["{min}", "{money_symbole}"], [Main::getInstance()->getConfigFile("config")->get("pay_min"), Main::getInstance()->getConfigFile("config")->get("money_symbole")], Main::getInstance()->getConfigFile("config")->get("minimum_pay")));
            return;
        }
        if ($money > $max){
            $payer->sendMessage(str_replace(["{max}", "{money_symbole}"], [Main::getInstance()->getConfigFile("config")->get("pay_max"), Main::getInstance()->getConfigFile("config")->get("money_symbole")], Main::getInstance()->getConfigFile("config")->get("maximum_pay")));
            return;
        }
        if ($this->seeMoney($payer) >= $money){
            $this->removeMoney($payer, $money);
            $this->addMoney($recever, $money);
            $payer->sendMessage(str_replace(["{player}", "{money_symbole}", "{money}"], [$recever->getName(), Main::getInstance()->getConfigFile("config")->get("money_symbole"), $money], Main::getInstance()->getConfigFile("config")->get("payer_message")));
            $recever->sendMessage(str_replace(["{player}", "{money_symbole}", "{money}"], [$payer->getName(), Main::getInstance()->getConfigFile("config")->get("money_symbole"), $money], Main::getInstance()->getConfigFile("config")->get("recever_message")));
        }else{
            $payer->sendMessage(Main::getInstance()->getConfigFile("config")->get("missing_money"));
        }
    }
}