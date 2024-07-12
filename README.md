# VanillaEconomy
New economy for PMMP with api

Commandes
* [X] /mymoney
* [X] /seemoney (player)
* [X] /topmoney
* [X] /pay (player) (money)
---------- STAFF -----------
* [X] /givemoney (player) (money)
* [X] /takemoney (player) (money)

## CONFIGURATION

```yaml
#$$$$$$$\                                           $$$$$$\
#$$  __$$\                                         $$  __$$\
#$$ |  $$ | $$$$$$$\ $$\   $$\  $$$$$$$\  $$$$$$\  $$ /  \__|$$$$$$\  $$\   $$\
#$$$$$$$  |$$  _____|$$ |  $$ |$$  _____|$$  __$$\ $$$$\    $$  __$$\ $$ |  $$ |
#$$  ____/ \$$$$$$\  $$ |  $$ |$$ /      $$ /  $$ |$$  _|   $$$$$$$$ |$$ |  $$ |
#$$ |       \____$$\ $$ |  $$ |$$ |      $$ |  $$ |$$ |     $$   ____|$$ |  $$ |
#$$ |      $$$$$$$  |\$$$$$$$ |\$$$$$$$\ \$$$$$$  |$$ |     \$$$$$$$\ \$$$$$$  |
#\__|      \_______/  \____$$ | \_______| \______/ \__|      \_______| \______/
#                    $$\   $$ |
#                    \$$$$$$  |
#                     \______/
# https://discord.gg/vanillamcbe
# https://github.com/psycofeu

# -------------------------------- MYMONEY ------------------------------------------

mymoney_descritption: "See my money"
mymoney_message: "§g- §fYou have §g{money}{money_symbole}§f !"

# -------------------------------- SEEMONEY ------------------------------------------

seemoney_descritpion: "See plager money ( /seemoney (player_name) )"
seemoney_message: "§g- §fThe player §g{player} §fhave §g{money}{money_symbole}§f !"

# -------------------------------- TOP MONEY ------------------------------------------

topmoney_description: "See server top money"
topmoney_base: "§a- §fTop Money §a-"
topmoney_line: "§2#{top} §a{player} {money}{money_symbole}"
topmoney_count: 5

# -------------------------------- PAY ------------------------------------------

pay_description: "Pay player"
payer_message: "§g- §fYou just paid §2{player} §a{money}{money_symbole}§f!"
recever_message: "§g- §fYou have just received §a{money}{money_symbole}§f from the player §2{player} §f!"
pay_min: 1 # minimum 1
pay_max: 100000000000
minimum_pay: "§c- §fYou must pay minimum {min}{money_symbole}"
maximum_pay: "§c- §fYou must pay maximum {max}{money_symbole}"
no_pay_youself: "§c-§f You cant pay youself !"

# -------------------------------- GIVEMONEY ------------------------------------------

givemoney_description: "Add player money"
givemoney_sender_message: "§g- §fYou just give §a{money}{money_symbole} §fto §2{player}§f!"
givemoney_gived_player: "§g- §fYou have just got §a{money}{money_symbole} §f!"

# -------------------------------- TAKEMONEY ------------------------------------------

takemoney_description: "remove player money"
takemoney_sender_message: "§g- §fYou just remove §a{money}{money_symbole} §fto §2{player}§f!"
takemoney_taked_player: "§g- §fYou have just got §a{money}{money_symbole} §f!"

# -------------------------------- GLOBALE ------------------------------------------

missing_player: "§c- §fYou must enter a player !"
player_dont_exist: "§c- §fThe player §c{player}§f does not exist !"
missing_money: "§c- §fyou don't have enough money"
missing_int: "§c- §fYou must enter a number !"
minimum_1: "§c- §fYou must pay minimum 1{money_symbole}"
default_money: 1000
money_symbole: "$"
no_permission: "§c- §fYou dont have permission §c{permission}§f !"
```

For Dev:
### SetMoney
```PHP
        vanillaAPI::getInstance()->setMoney($player, $money);
```
### addMoney
```PHP
        vanillaAPI::getInstance()->addMoney($player, $money);
```
### removeMoney
```PHP
        vanillaAPI::getInstance()->removeMoney($player, $money);
```
### getMoney
```PHP
        vanillaAPI::getInstance()->seeMoney($player);
```

contacts:

- [![Discord](https://img.shields.io/discord/1216200805988827267?label=Discord&logo=discord&color=blue)](https://discord.gg/vanillamcbe)

