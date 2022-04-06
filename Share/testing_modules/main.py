# imported files http://magma-mc.net/Share/testing_mpodules/files/

import pgzrun

WIDTH = 400
HEIGHT = 400

hello = Actor('round', (200, 200))

def draw():
    hello.draw()

pgzrun.go()