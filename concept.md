# Concept

This document provides early insight into the ideas for this application.

The MediaCafe Application is a web application that manages a full TV Series, Movies and Music library. 

__Features__
- Scan existing files for import into library
- Retrieve metadata from thetvdb, themoviedb and theaudiodb
- Add new shows, movies and music to your library
- Tracks, Episodes or movies not on disk can be searched for on Torrent sites using [TorrentPotato](https://github.com/RuudBurger/CouchPotatoServer/wiki/Couchpotato-torrent-provider) API
- Auto download above mentioned media if found available through RSS feeds from [TorrentPotato](https://github.com/RuudBurger/CouchPotatoServer/wiki/Couchpotato-torrent-provider)
- Push the torrents to an compatible torrent program (e.a. transmission)
- Once the torrent completes move/copy/hardlink to the corresponding folder
- Rename folders to provided format
- Rename movies/episoded to provided format
- Push notification to several services to notify of on-grap/on-download/on-rename/on-upgrade
- Calendar functionality containing all releases of episodes and movies
- Auto add to library using last.fm

__Screens__
- Library overview
  - Series
  - Movies
  - Music
  - Add
- Calendar
- Activity (showing currently downloading and failed downloads)
- Wanted
- Settings
  - Media management
  - Quality
  - Indexers
  - Download client
  - Notifications
  - User management
  - UI
  - Updates
  - Tasks
  - Backups
  - Logs
  - System

__Models__
- MediaItem
  - title (string)
  - slug (string, unique)
  - type (movie, show, season, episode, artist, album, cd, track) (string)
  - parent_id (int, fk media_items.id)
  - number (int)
  - description (string)
  - airDate (datetime)
  - genre (string)
  - quality_id (int)
  - monitored (bool)
  - path (string)
  - network (e.a. Marvels) (string) 
- MetaSource
  - implementation (string)
  - meta_id (string)
  - MediaItemId (int, fk media_items.id)
- File
  - media_item_id (int, fk media_items.id)
  - quality_id (int, fk qualities.id)
  - relativePath (string)
  - path (string)
  - sizeOnDisk (int)
  - dateAdded (date)
- Torrent
  - media_item_id (int, fk media_items.id)
  - quality_id (int, fk qualities.id)
  - indexer_id (int, fk indexers.id)
  - title (string)
  - publishDate (date)
  - size (int)
  - blacklisted (bool)
  - commentUrl (string)
  - downloadUrl (string)
  - infoUrl (string)
  - magnetUrl (string)
  - infoHash (string)
  - seeders (int)
  - leechers (int)
- Indexer
  - name (string)
  - implementation (string)
  - settings (json)
- Quality
  - title (string)
  - type (movie, show, season, episode, artist, album, cd, track) (string)
  - weight (int)
  - minSize (int)
  - maxSize (int)
- Profile
  - title (string)
  - type (movie, show, season, episode, artist, album, cd, track) (string)
  - language (string)
  - cutoff_id (int, fk qualities.id)
  - qualities (many-many)