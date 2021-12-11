# Neos.Wallpapers

The package will choose a random wallpaper image for the Neos Login screen. It includes the wallpaper images Neos 
included in the past and used those as default. The source folders for the images can be configured so this package 
can also be used with cutom image collections.

## Configuration  

```
Neos:
  Wallpapers:
    #
    # The fallback source is used when the configured sources below do not yield 
    # any jpg files. By default the Wallpaper of Neos is used as default. 
    # 
    fallbackSource: 'resource://Neos.Neos/Public/Images/Login/Wallpaper.jpg'
    
    #
    # The sources are folders that are expected to contain jpg files all folders are
    # scanned recursively for jpg files of wich one is picked randomly to which the 
    # wallpaper image request is forwarded.
    #
    sources:
      neos_wallpapers: 'resource://Neos.Wallpapers/Public/Images/Neos_Wallpapers'
```

