import pygame
class SpriteSheet:
    def __init__(self, sprite_image, pixels, width, height):
        self._sprite = sprite_image
        self._sprite_pixel = pixels
        self._sprite_width = width
        self._sprite_height = height
    def loads(self, actor, spritesetting):
        x, y, scale, name = spritesetting
        pixels = self._sprite_pixel
        width = self._sprite_width
        height = self._sprite_height
        pixel_x, pixel_y = pixels
        image = pygame.Surface((width, height)).convert()
        try:
            image.blit(
                images.load("images/"+str(self._sprite)), 
                (-(x*pixel_x), -(y*pixel_y)), 
                (width, height, width, height)
                )
        except Exception as e:
            print(e)
            image.blit(pygame.image.load("//images/"+self._sprite +".png").convert(), (0, 0), (x*pixel_x, y*pixel_y, width, height))
            image.set_colorkey((255,255,255), pygame.RLEACCEL)
        image = pygame.transform.scale(image, (width * scale, height * scale))
        
        # web
        actor._image_name = name
        actor._orig_surf = image
        # app
        actor._surf = image
        try:
            del actor._surface_cache[:]  # Clear out old image's cache.
        except:
            pass
        actor._update_pos()

    def load(actor, spritesetting):
        sheet, pixels, x, y, width, height, scale, name = spritesetting
        pixel_x, pixel_y = pixels
        image = pygame.Surface((width, height)).convert_alpha()
        image.blit(pygame.image.load("images/"+sheet+".png"), (0, 0), (x*pixel_x, y*pixel_y, width, height))
        image = pygame.transform.scale(image, (width * scale, height * scale))
        # web
        actor._image_name = name
        actor._orig_surf = image
        # app
        actor._surf = image
        
        try:
            del actor._surface_cache[:]  # Clear out old image's cache.
        except:
            pass
        actor._update_pos()
