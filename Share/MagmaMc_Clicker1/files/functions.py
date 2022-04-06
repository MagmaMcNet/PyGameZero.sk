def Recolor(surface, colors):
    w, h = surface.get_size()
    r, g, b = colors
    for x in range(w):
        for y in range(h):
            a = surface.get_at((x, y))[3]
            surface.set_at((x, y), pygame.Color(r, g, b, a))

def key_exists(json, key):
    try:
        exist = json[key]
    except:
        return False
    return True

def skin_cost(number, cost, istext):
    global save
    b = 0
    try:
        exist = save[number]
        b = 1
    except:
        b = 0
    if b == 0:
        if istext:
            return cost
        else:
            if int(save["Coins"]) >= (int(cost)):
                save["Coins"] = str(int(save["Coins"]) - (int(cost)))
                save["Skin"] = number
                save.update({number: "yes"})
                player.image = "Skin"+save["Skin"]
            return False
    if istext:
        if save["Skin"] == number:
            return "Equiped"
        return "Already Owned"
    else:
        save["Skin"] = number
        player.image = "Skin"+save["Skin"]
        return True

def AutoClicker():
    global save
    save["Coins"] = str(int(save["Coins"]) + int(save["Skin"])*int(save["AutoClicker"]))