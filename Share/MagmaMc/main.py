# files http://magma-mc.net/Share/MagmaMc_Clicker1/
from random import randint
import filez
import json
from math import floor
WIDTH = 1280
HEIGHT = 720
FPS = 30
TITLE = "Animal Clicker"

mode = "Menu"
dev = False


title = Actor("title", center=(WIDTH/2, 325), anchor=('center', 'center'))
bg = Actor("BG")
bg_main = Actor("Grass")
bg_other = Actor("BG_other")
# Buttons
x_button = Actor("redbox", center=(1250, 30))
play_button = Actor("Play_Button", center=(WIDTH/2, 400))
shop_button = Actor("Shop_Button", center=(WIDTH/2, 450))
skin_button = Actor("Skins_Button", center=(WIDTH/2, 500))
option_button = Actor("Options_button", center=(WIDTH/2, 550))
Red_buttons = []
b = 0.0
c = 0
d = 1
for i in range(1,16):
    actor = Actor("red_button",
        center=(
            (500+((c)*256)), 
            (140+(((floor(b*10))*70)%350))
            )
        )
    if d == 5:
        d = 0
        c += 1
    b += 0.101
    d += 1
    Red_buttons.append(actor)
yellow_button1 = Actor("yellow_button", center=(1140, 2*70))
blue_button1 = Actor("blue_button1", center=(1140, 3*70))

# Settings
box_none = Actor("box_none", center=(170, 250))
box_tick = Actor("box_tick", center=(170, 250))

box_none2 = Actor("box_none", center=(170, 310))
box_tick2 = Actor("box_tick", center=(170, 310))

box_none3 = Actor("box_none", center=(170, 370))
box_tick3 = Actor("box_tick", center=(170, 370))

#Vars
sound = True
music = True
animation = True
player_animate = False
# Images
player = Actor("Skin1", pos=(300, 310))
Smoke = []

for num in range(1,8):
    r = randint(30,60)
    actor = Actor("Smoke_0"+str(num), pos=(-200, -200))
    actor._orig_surf = pygame.transform.scale(actor._orig_surf, (r, r))
    actor._update_pos()
    Recolor(actor._orig_surf, (randint(40, 100), randint(10, 50), randint(10, 50)))
    Smoke.append(actor)

# Change Image Scale
player._orig_surf = pygame.transform.scale(player._orig_surf, (300, 300))
title._orig_surf = pygame.transform.scale(title._orig_surf, (600, 80))
bg._orig_surf = pygame.transform.scale(bg._orig_surf, (1524, 1584))
bg_main._orig_surf = pygame.transform.scale(bg_main._orig_surf, (1524, 1584))
bg_other._orig_surf = pygame.transform.scale(bg_other._orig_surf, (1524, 1584))
for i in Red_buttons:
    i._orig_surf = pygame.transform.scale(i._orig_surf, (250, 64))
yellow_button1._orig_surf = pygame.transform.scale(yellow_button1._orig_surf, (250, 64))
blue_button1._orig_surf = pygame.transform.scale(blue_button1._orig_surf, (250, 64))

# Settings
box_none._orig_surf = pygame.transform.scale(box_none._orig_surf, (40, 40))
box_tick._orig_surf = pygame.transform.scale(box_tick._orig_surf, (40, 40))
box_none2._orig_surf = pygame.transform.scale(box_none._orig_surf, (40, 40))
box_tick2._orig_surf = pygame.transform.scale(box_tick._orig_surf, (40, 40))
box_none3._orig_surf = pygame.transform.scale(box_none._orig_surf, (40, 40))
box_tick3._orig_surf = pygame.transform.scale(box_tick._orig_surf, (40, 40))
box_none._update_pos()
box_tick._update_pos()
box_none2._update_pos()
box_tick2._update_pos()
box_none3._update_pos()
box_tick3._update_pos()


player._update_pos()
title._update_pos()
bg._update_pos()
bg_main._update_pos()
bg_other._update_pos()
#for i in range(1,11):
#    globals()["red_button"+str(i)]._update_pos()

yellow_button1._update_pos()
blue_button1._update_pos()
bg_main.y = 325
bg.y = 360
bg_other.y = 360
player.y = 470
Mouse_pos = ()
# Save The Players Data

class PlayerData:
    def SAVE():
        filez.fwrite('/Saves/'+str(Cookies.get("UserID"))+'.json', json.dumps(save, sort_keys=True, indent=4), "c")
    def GET():
        return str(filez.fread('/Saves/'+str(Cookies.get("UserID"))+'.json'))


# Player Settings
save = json.loads(PlayerData.GET())
if not key_exists(save, "Coins"):
    save.update({"Coins":"1"})
if not key_exists(save, "Upgrade"):
    save.update({"Upgrade":"1"})
if not key_exists(save, "Skin"):
    save.update({"Skin":"1"})
if not key_exists(save, "Name"):
    name = input("enter name: ")
    save.update({"Name": name})
if not key_exists(save, "1"):
    save.update({"1": "yes"})
if not key_exists(save, "AutoClicker"):
    save.update({"AutoClicker": "0"})
# Skin cost
cost = {
    "Skin_1": "100",
    "Skin_2": "400",
    "Skin_3": "1000",
    "Skin_4": "2500",
    "Skin_5": "6000",
    "Skin_6": "15000",
    "Skin_7": "40000",
    "Skin_8": "60000",
    "Skin_9": "100000",
    "Skin_10": "220000",
    "Skin_11": "60000",
    "Skin_12": "100000",
    "Skin_13": "220000",
    "Skin_14": "100000",
    "Skin_15": "220000"
}
player.image = "Skin"+save["Skin"]

def background_music():
    global music
    if music == True:
         Sounds.background.stop()
         Sounds.background.play()
background_music()
clock.schedule_interval(PlayerData.SAVE, 1)
clock.schedule_interval(AutoClicker, 1)
clock.schedule_interval(background_music, 66)

def draw():
    global player_animate, animation, a
    #470 true
    if player_animate and animation:
        if player.y < 470: # if 270 is 
            player_animate = False
        else:
            if player.y >= 471 and player.y < 479:
                player.y -= 0.5
            else:
                player.y -= 0.15
    elif not player_animate and animation:
        if player.y >= 480:
            player_animate = True
        else:
            if player.y >= 471 and player.y < 479:
                player.y += 0.5
            else:
                player.y += 0.15
    
    screen.clear()
    
    if mode == "Menu":
        bg.draw()
        play_button.draw()
        shop_button.draw()
        skin_button.draw()
        option_button.draw()
        title.draw()
    elif mode == "Shop":
        bg_other.draw()
        yellow_button1.draw()
        blue_button1.draw()
        screen.draw.text(str((int(save["Upgrade"]) * int(save["Upgrade"]))*50 ), center=(1140, 2*70-5))
        screen.draw.text(str((int(save["AutoClicker"]) *50* int(save["AutoClicker"]))+1*100), center=(1140, 3*70-5))
        
    elif mode == "Skins":
        bg_other.draw()
        for button in Red_buttons:
            button.draw()
        player.draw()
        b = 0.0
        c = 0
        d = 1
        n = 0
        for i in Red_buttons:
            n += 1
            if n == 16:
                break
            screen.draw.text(
                skin_cost(str(int(b*10)+1), cost["Skin_"+str(int(b*10)+1)], True),
                center=(
                    (530+((c)*256)), 
                    (140+(((floor(b*10))*70)%350))
                    )
                )
            if d == 5:
                d = 0
                c += 1
            b += 0.101
            d += 1
    elif mode == "Game":
        bg_main.draw()

        player.draw()
        for particle in Smoke:
            particle.draw()
    elif mode == "Settings":
        bg_other.draw()
        
        if not sound:
            box_none.draw()
        else:
            box_tick.draw()
        
        if not music:
            box_none2.draw()
        else:
            box_tick2.draw()
        
        if not animation:
            box_none3.draw()
        else:
            box_tick3.draw()
        screen.draw.text("Sound: ", pos=(15,230), fontsize=30, color="black", bold="true")
        screen.draw.text("Music: ", pos=(15,290), fontsize=30, color="black", bold="true")
        screen.draw.text("Animate: ", pos=(15,350), fontsize=30, color="black", bold="true")
        
        
    if mode != "Menu":
        x_button.draw()
            
        if mode != "Settings":
            screen.draw.text("coins: " + save["Coins"], pos=(5,70), fontsize=30, color="black", bold="true")
            screen.draw.text("clicker: "+ save["Upgrade"], pos=(5,100), fontsize=30, color="black", bold="true")
            screen.draw.text("AutoClicker: "+ save["AutoClicker"], pos=(5,130), fontsize=30, color="black", bold="true")

            
    

def on_key_up(key):
    global dev, save
    if key == 112:
        if not dev:
            a = input("dev password")
            if a == "dev":
                dev = True
    if dev:
        if key == 99:
            save["Coins"] = str(int(input("Coins: ")))
            
        if key == 120:
            save["Upgrade"] = str(int(input("Upgrade: ")))

def on_mouse_up(button, pos):
    global Smoke
    for smoke in range(0,7):
        Smoke[smoke].pos = (-200, -200)
def on_mouse_move(pos):
    global Mouse_pos
    
    Mouse_pos = pos
def on_mouse_down(button, pos):
    global save, upgrade, mode, dev, cost, a
    global sound, music, animation
    if mode == "Skins":
        a = 0
        for i in Red_buttons:
            a += 1
            if i.collidepoint(pos):
                if sound:
                    Sounds.click.play()
                skin_cost(str(a), cost["Skin_"+str(a)], False)

    elif mode == "Shop":
        if yellow_button1.collidepoint(pos):
            if sound:
                Sounds.click.play()
            if int(save["Coins"]) >= (int(save["Upgrade"]) * int(save["Upgrade"]))*50:
                save["Coins"] = str(int(save["Coins"]) - (int(save["Upgrade"]) * int(save["Upgrade"]))*50 )
                save["Upgrade"] = str(int(save["Upgrade"]) + 1)
        
        if blue_button1.collidepoint(pos):
            if sound:
                Sounds.click.play()
            if int(save["Coins"]) >= int(save["AutoClicker"]) *50* int(save["AutoClicker"])+1*100:
                save["Coins"] = str(int(save["Coins"]) - (int(save["AutoClicker"]) *50* int(save["AutoClicker"])+1*100))
                save["AutoClicker"] = str(int(save["AutoClicker"]) + 1)
    elif mode == "Game":
        if player.collidepoint(pos):
            save["Coins"] = str(int(save["Coins"]) + int(save["Skin"])*int(save["Upgrade"]))
            smoke_numb = randint(0,6)
            Smoke[smoke_numb].pos = pos
            if sound:
                Sounds.click.play()
    if mode == "Menu":
        if play_button.collidepoint(pos):
            if sound:
                Sounds.click.play()
            mode = "Game"
        elif shop_button.collidepoint(pos):
            if sound:
                Sounds.click.play()
            mode = "Shop"
        elif skin_button.collidepoint(pos):
            if sound:
                Sounds.click.play()
            mode = "Skins"
        elif option_button.collidepoint(pos):
            if sound:
                Sounds.click.play()
            mode = "Settings"
    else:
        if x_button.collidepoint(pos):
            if sound:
                Sounds.click.play()
            mode = "Menu"
    # Settings
    if mode == "Settings":
        if box_none.collidepoint(pos):
            sound = not sound
            if sound:
                Sounds.click.play()
        if box_none2.collidepoint(pos):
            music = not music
            if sound:
                Sounds.click.play()
            if not music:
                Sounds.background.stop()
            else:
                Sounds.background.play()

        if box_none3.collidepoint(pos):
            animation = not animation
            if sound:
                Sounds.click.play()
