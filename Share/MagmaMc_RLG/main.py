# imported files http://magma-mc.net/Share/MagmaMc_RLG/files/


# planned update multiplayer
# ore mining
# enemies
import json
import filez
import pgzrun
import pygame
import time
from random import randint
try:
    from files.Class_Functions import SpriteSheet
    filez.ID = "MagmaMc_RLG"
except:
    pass
TITLE = "Dungeons"
FPS = 30
spawn_pos = (64, 128)
cell_scale = 64
block = Actor('default')
item = Actor('default', pos=(100, 100))
player = Actor('default', pos=(spawn_pos[0], spawn_pos[1]))

CurrentWave = 1
players = []
enemies = []
hearts = []
damage_boosts = []
leaderboard = []
username = input('Username: ')
inputpass = input('Password: ')


try:
    userdatatemp = json.loads(str(filez.fread("/"+username+".json")))
    savedpass = userdatatemp["password"]
   
    if savedpass == inputpass:
        userdata = json.loads(str(filez.fread("/"+username+".json")))
        a_left = float(userdata["x"])
        a_top = float(userdata["y"])
        a_damage = int(userdata["Damage"])
        a_health = int(userdata["Health"])
        CurrentWave = int(userdata["Wave"])
except:
    try:
        userdata = json.loads(str(filez.fread("/"+username+".json")))
        userdata["y"] = str(player.bottom)
        userdata["x"] = str(player.left)
        userdata.update({"password": inputpass})
        userdata.update({"username": username})
        userdata.update({"randomskin": str(randint(1, 4))})
        userdata.update({"numb": str(time.time()+5.0)})
        userdata.update({"Damage": "5"})
        userdata.update({"Health": "100"})
        userdata.update({"Wave": "1"})
        filez.fwrite("/"+username+".json", json.dumps(userdata, sort_keys=True, indent=4), "c")
    except:
        pass

def getplayer():
    global players, leaderboard
    playerdata = filez.scan('/')
    try:
        players = []
    except:
        pass
    for playerfilename in playerdata:
        if playerfilename != username+".json" and playerfilename != ".json" and playerfilename != '[':
            playerfile = json.loads(str(filez.fread("/"+str(playerfilename))))
            try:
                
                otherplayer = Actor('player'+playerfile["randomskin"], bottomleft=(float(playerfile["x"]), float(playerfile["y"])) )
                otherplayer._orig_surf = pygame.transform.scale(otherplayer._orig_surf, (otherplayer.width*0.6, otherplayer.height*0.6))
                otherplayer._update_pos()
                otherplayer.bottom = float(playerfile["y"])
                otherplayer.left = float(playerfile["x"])
                otherplayer.username = playerfile["username"]
                otherplayer.Wave = playerfile["Wave"]
            except Exception as e:
                print(e)
            if float(playerfile["numb"]) > time.time():
                leaderboard.append(int(playerfile["Wave"]))
                players.append(otherplayer)
def saveplayer():
    if player.DAMAGE/5 < 5:
        items.loads(item, (42+player.DAMAGE/5, 6, 2, "sword"))
    elif player.DAMAGE/5 < 8:
        items.loads(item, (42, player.DAMAGE/5-5, 2, "staff"))
    else:
        items.loads(item, (42, 3, 2, "staff"))
    global userdata
    userdata["y"] = str(player.bottom)
    userdata["x"] = str(player.left)
    userdata["numb"] = str(time.time()+5.0)
    userdata["Damage"] = str(player.DAMAGE)
    userdata["Health"] = str(player.HP)
    userdata["Wave"] = str(CurrentWave)
    filez.fwrite('/'+username+'.json', json.dumps(userdata, sort_keys=True, indent=4), "c")
def playerdead():
    global player, CurrentWave
    CurrentWave = 1
    Functions.wave(1)
    player.bottom = 128
    player.left = 64
    player.DAMAGE = 5
    player.HP = 100
    
clock.schedule_interval(saveplayer, 0.1)
clock.schedule_interval(getplayer, 0.2)

isweb = True

sprites = {
    "tiles": {
        0: (16, 16, 4, "border1"),
        1: (17, 16, 4, "border2"),
        2: (18, 16, 4, "border3"),
        3: (19, 16, 4, "border4"),
        4: (16, 10, 4, "floor1"),
        5: (17, 10, 4, "floor2"),
        6: (18, 10, 4, "floor3"), 
    },
    "entitys": {
        0: (0, 0, 4, "zombie"),
        1: (1, 0, 4, "skeleton"),
    },
    "objects": {
        0: (),
        1: (14, 10, 4, "coal ore"),
        2: (14, 10, 4, "coal ore"),
        3: (14, 10, 4, "coal ore"),
        4: (14, 13, 4, "copper ore"),
        5: (14, 13, 4, "copper ore"),
        6: (15, 12, 4, "gold ore"),
        7: (15, 13, 4, "emerald ore"),
        8: (9, 3, 4, "crack1"),
        9: (9, 3, 4, "crack1"),
        10: (9, 3, 4, "crack1"),
        11: (10, 3, 4, "crack2"),
        12: (10, 3, 4, "crack2"),
        13: (10, 3, 4, "crack2"),
    }
}


# Default sheets


items = SpriteSheet("items", (17, 17), 16, 16)
ens = SpriteSheet("Enemies", (17, 17), 16, 16)
char = SpriteSheet("character", (96, 128), 96, 126)
char.loads(player, (3, 2, 0.6, "idle"))
try:
    player.bottom = a_top
    player.left = a_left
except:
    player.left = spawn_pos[0]
    player.bottom = spawn_pos[1]


try:
    player.HP = a_health
    player.DAMAGE = a_damage
except:
    player.HP = 100
    player.DAMAGE = 5
    
player.isidle = 20


items.loads(item, (42, 6, 2, "sword"))

level = 1


item_pos = (0, 0)
item_angle = 0
map_tiles = [
    { # 1
        "tiles": [
            [3, 2, 0, 2, 2, 0, 1, 2, 3, 0, 3, 2, 0, 2, 2, 0, 3, 0],
            [1, 4, 4, 5, 5, 4, 4, 5, 4, 6, 4, 4, 4, 5, 6, 4, 4, 1],
            [1, 4, 6, 4, 5, 5, 4, 6, 4, 5, 5, 4, 6, 4, 5, 5, 4, 3],
            [0, 4, 4, 5, 4, 5, 4, 4, 5, 4, 6, 4, 4, 5, 4, 6, 4, 3],
            [2, 4, 6, 4, 4, 6, 4, 5, 4, 4, 4, 6, 4, 5, 4, 4, 5, 0],
            [3, 4, 4, 4, 5, 4, 4, 5, 4, 4, 4, 5, 4, 4, 4, 5, 4, 1],
            [0, 4, 5, 4, 4, 4, 4, 5, 4, 4, 4, 5, 4, 4, 4, 5, 4, 3],
            [3, 4, 4, 4, 4, 4, 4, 5, 4, 4, 6, 4, 4, 5, 4, 4, 4, 1],
            [0, 4, 4, 4, 4, 4, 4, 5, 4, 4, 6, 4, 4, 4, 4, 5, 6, 3],
            [0, 0, 3, 0, 1, 2, 0, 2, 2, 0, 3, 0, 1, 2, 0, 2, 3, 3],
        ],
        "Objects": [
            [1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1],
            [1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1],
            [1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1],
            [1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1],
            [1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1],
            [1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1],
            [1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1],
            [1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1],
            [1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1],
            [1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1], # 1 = disable Objects
            
        ],
    }
]
WIDTH = len(map_tiles[0]["tiles"][1]) * cell_scale
HEIGHT = len(map_tiles[0]["tiles"]) * cell_scale
map_level = []
map_level_obj = []

c1 = 0

class Functions:
    def draw_test():
        screen.draw.text(str(player.HP)+"HP", pos=(5, 30), color=(200, 50, 0), bold="true", fontsize=25)
        screen.draw.text("Wave: "+str(CurrentWave-1), pos=(5, 60), color=(200, 50, 0), bold="true", fontsize=25)
    def wave(wave):
        global enemies
        enemies = []
        if wave == 5:
            clock.schedule_interval(path_enemies, 0.5)
        if wave <= 4:
            for _ in range(wave+1):
                enemy = Actor('default')
                enemy.STRENGTH = randint(0,1)+1
                ens.loads(enemy, (randint(0,1),enemy.STRENGTH-1, 4, "Die"))
                enemy.Status = "Idle"
                enemy.HP = enemy.STRENGTH*20
                enemy.DAMAGE = enemy.STRENGTH*5
                enemy.top = 64*randint(2,8)
                enemy.left = 64*randint(2,16)
                enemies.append(enemy)
        elif wave <= 6:
            for _ in range(wave+1):
                enemy = Actor('default')
                enemy.STRENGTH = randint(0,2)+2
                ens.loads(enemy, (randint(0,1),enemy.STRENGTH-2, 4, "Die"))
                enemy.Status = "Idle"
                enemy.HP = enemy.STRENGTH*35
                enemy.DAMAGE = enemy.STRENGTH*5
                enemy.top = 64*randint(2,8)
                enemy.left = 64*randint(2,16)
                enemies.append(enemy)
        else:
            for _ in range(wave+1):
                enemy = Actor('default')
                enemy.STRENGTH = randint(0,3)+2
                ens.loads(enemy, (randint(0,1),enemy.STRENGTH-2, 4, "Die"))
                enemy.Status = "Idle"
                enemy.HP = enemy.STRENGTH*50
                enemy.DAMAGE = enemy.STRENGTH*5
                enemy.top = 64*randint(2,8)
                enemy.left = 64*randint(2,16)
                enemies.append(enemy)
        
    def taken_damage(subject, other):
        other.HP -= subject.DAMAGE
        other.Status = "Attacked"
        if other.HP <= 0:
            other.Status = "Dead"
            if randint(1,6) == 1:
                Heal = Actor('health', pos=other.pos)
                hearts.append(Heal)
            elif randint(1,12) == 1:
                Heal = Actor('damage_boost', pos=other.pos)
                damage_boosts.append(Heal)
                
            other.pos = (-100, -100)

    def current_level(readlevel):
        global map_level
        sheet = SpriteSheet("map", (17, 17), 16, 16)
        try:
            del map_level[:]
        except:
            pass
        for h in range(len(map_tiles[readlevel-1]["tiles"])):
            for w in range(len(map_tiles[readlevel-1]["tiles"][1])):
                cell = Actor('default')
                sheet.loads(cell, sprites["tiles"][map_tiles[readlevel-1]["tiles"][h][w]])
                cell.left = cell.width * w
                cell.top = cell.height * h
                if randint(0, 7) == 0 and map_tiles[readlevel-1]["Objects"][h][w] == 0:
                    cell_object = Actor('default')
                    sheet.loads(cell_object, sprites["objects"][randint(1,13)])
                    cell_object.left = cell_object.width * w
                    cell_object.top = cell_object.height * h
                    map_level_obj.append(cell_object)
                map_level.append(cell)
saywave = 0
Functions.current_level(1)
def DoWaves():
    global c1, CurrentWave, saywave
    ch = 0
    
    for i in enemies:
        ch += i.HP
    if ch <= 0:
        if c1 >= 2:
            Functions.wave(CurrentWave)
            saywave = 40
            c1 = 0
            CurrentWave += 1
        else:
            c1 += 1
Functions.wave(CurrentWave)
clock.schedule_interval(DoWaves, 0.5)
def collects():
    global hearts, damage_boosts
    CurrentDamage = []
    CurrentHearts = []
    for heart in hearts:
        heart.draw()
        if heart.x > 0:
            CurrentHearts.append(heart)
    hearts = CurrentHearts
    for boost in damage_boosts:
        boost.draw()
        if boost.x > 0:
            CurrentDamage.append(boost)
    damage_boosts = CurrentDamage
    
def draw():
    global saywave
    if player.image == "idle":
        item_pos = (player.x+18, player.y+8)
        item_angle = 0
    elif player.image == "up":
        item_pos = (player.x-6, player.y+10)
        item_angle = 0
    elif player.image == "down":
        item_pos = (player.x+12, player.y+22)
        item_angle = 70
    elif player.image == "right":
        item_pos = (player.x+34, player.y+28)
        item_angle = -50
    elif player.image == "left":
        item_pos = (player.x-12, player.y+14)
        item_angle = 50
        
    item.pos = item_pos
    item.angle = item_angle
    screen.clear()
    for tile in map_level:
        tile.draw()
    for tile in map_level_obj:
        tile.draw()
    for other in players:
        try:
            if "Magma" in other.username:
                screen.draw.text(other.username, center=(other.x, other.y-45), fontsize=15, color=(232, 185, 35), bold="true")
            else:
                screen.draw.text(other.username, center=(other.x, other.y-45), fontsize=15, color="black", bold="true")
            if max(leaderboard) == int(other.Wave) and max(leaderboard) > CurrentWave:
                screen.draw.text(str(int(other.Wave)-1 ), center=(other.x, other.y-30), fontsize=10, color=(232, 185, 35), bold="true")
            else:
                screen.draw.text(str(int(other.Wave)-1 ), center=(other.x, other.y-30), fontsize=10, color="black", bold="true")
        except:
            pass
        other.draw()
    if player.image == "up":
        item.draw()
        player.draw()
    else:
        player.draw()
        item.draw()
    
    for en in enemies:
        en.draw()
    collects()
    Functions.draw_test()
    if saywave >= 0:
        saywave -= 1
        screen.draw.text("Wave "+str(CurrentWave-1), fontsize=35, color="black", bold="true", center=(WIDTH/2, HEIGHT/2))
    if player.HP <= 0:
        screen.fill("black")
        screen.draw.text("You Lose", color="red", fontsize=35, center=(WIDTH/2, HEIGHT/2))
        clock.schedule(playerdead, 2)
        

def takeClosest(lst, numb):
    newlst = []
    for i in lst:
        newlst.append(i - numb)
    lstt = [abs(ele) for ele in newlst]
    return lst[lstt.index(min(lstt))]

def path_enemies():
    enemie_move()

def enemie_move():
    for en in enemies:
        if en.Status == "Attacked":
            if en.left != player.left:
                list_x = [en.left+cell_scale, en.left-cell_scale]
                en.left = takeClosest(list_x, player.left)
            elif en.bottom != player.bottom:
                list_y = [en.bottom-cell_scale, en.bottom+cell_scale]
                en.bottom = takeClosest(list_y, player.bottom)
            elif en.left == player.left and en.bottom == player.bottom:
                Functions.taken_damage(en, player)
##

clock.schedule_interval(path_enemies, 0.5)
    

def update(dt):
    global item_pos, item_angle
    
    if player.isidle != 8:
        player.isidle += 1
    elif player.image != "idle":
        player.isidle = 0
        char.loads(player,(3, 2, 0.6, "idle"))
    for heart in hearts:
        if player.colliderect(heart):
            player.HP += randint(1,2)*10
            heart.pos = (-100, -100)
    
    for boost in damage_boosts:
        if player.colliderect(boost):
            if player.DAMAGE/5 < 8:
                player.DAMAGE += 5
            boost.pos = (-100, -100)
            items.loads(item, (42+int(player.DAMAGE/5), 6, 2, "sword"))

    
def on_mouse_down(button, pos):
    global enemies
    for en in enemies:
        if en.collidepoint(pos):
            Functions.taken_damage(player, en)
def on_key_down(key):
    if key == keys.W or key == keys.UP:
        if player.image != "up":
            char.loads(player,(0, 1, 0.6, "up"))
        player.isidle = 0
        if player.y > (cell_scale*2):
            player.y -= cell_scale
    elif key == keys.S or key == keys.DOWN:
        if player.image != "down":
            char.loads(player,(0, 0, 0.6, "down"))
        player.isidle = 0
        if player.y < HEIGHT-(cell_scale*2):
            player.y += cell_scale
    elif key == keys.A or key == keys.LEFT:
        if player.image != "left":
            char.loads(player,(0, 4, 0.6, "left"))
            player._orig_surf = pygame.transform.flip(player._orig_surf, True, False)
            player._surf = pygame.transform.flip(player._surf, True, False)
        player.isidle = 4
        if player.x > (cell_scale*2):
            player.x -= cell_scale
    elif key == keys.D or key == keys.RIGHT:
        if player.image != "right":
            char.loads(player,(0, 4, 0.6, "right"))
        player.isidle = 4
        if player.x < WIDTH-(cell_scale*2):
            player.x += cell_scale
pgzrun.go()