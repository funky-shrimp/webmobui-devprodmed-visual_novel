
# Full Stack Visual Novel

## Introduction
Welcome in the Visual Novel project.

This is a small project where you can play and create easy and small visual novels.

This project was made for Frontend and Backend courses I followed at [HEIG-VD](https://heig-vd.ch/) in [Media Engineering](https://heig-vd.ch/formation/bachelor/ingenierie-des-medias/).

The project uses [Laravel](https://laravel.com/) for Backend (API'S and Database managment) and [VueJS](https://vuejs.org/) for a dynamic Frontend.

## Getting started

### Requirements
For this project, you need [PHP 8.4](https://www.php.net/), [Composer 2.8.5](https://getcomposer.org/), [NPM 11.1](https://www.npmjs.com/) installed on your machine.

And a good dose of hope to make things work.

### Installation
Once you have forked this project, you can install front and back dependencies with 
```bash
composer install
npm install
npm run build
```

Then you have to check that sqlite is activated in your php .ini file
```bash
extension=pdo_sqlite
extension=sqlite3
```

Then in your project folder, copy the environment file for your own configuration and check if sqlite is activated :

```bash
DB_CONNECTION=sqlite
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=laravel
# DB_USERNAME=root
# DB_PASSWORD=
```

Before launching and playing, you have to populate the database, for this purpose I made a simple story (In french).  
Just run :
```
php artisan migrate:refresh --seed
```

### Launch

I made a small command in the package.json file to start both laravel and vite. Just type :
```bash
npm run serve
```

The server start on http://127.0.0.1:8000

Now you can enjoy creating and playing little stories :)

## Project Logic

### UML
![UML Diagram](https://github.com/funky-shrimp/webmobui-devprodmed-visual_novel/blob/main/docs/UML_diagram_v2.png?raw=true)
### Logic
The visual novel logic is not ideal, but it works. Here is an explanation.

-A story has 0 to many chapters  
-A chapter has 0 to many choices

You play a story, that begins with a starting chapter (see UML diagram), you make choices that bring you to other chapters.

If a _next_chapter_id_ entry for a choice is null, then it's the end of the story.

The image column for chapter is in fact the image name. The image sent to the API is coded in base64 then stored in the public folder. 

## API Documentation

You can find a Postman collection in the [docs](https://github.com/funky-shrimp/webmobui-devprodmed-visual_novel/blob/main/docs/Fullstack_Visual_Novel-postman_collection.json) of this project.

### Base URL
```
http://127.0.0.1:8000/api
```

### Stories

#### Get all stories

```http
  GET /stories
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| None      |          | Retrieves all stories.     |

#### Get story

```http
  GET /stories/${id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `string` | **Required**. Id of story to fetch |

#### Get story chapters

```http
  GET /stories/${id}/chapters
```

| Parameter | Type     | Description                              |
| :-------- | :------- | :--------------------------------------- |
| `id`      | `string` | **Required**. Id of story to fetch chapters for |

#### Create story

```http
  POST /stories
```

**Parameters:**
| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| None      |          |                            |

**Body:**
| Field     | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `title`   | `string` | **Required**. Title of the story |
| `summary` | `string` | **Required**. Summary of the story |

**Example Body:**
```json
{
  "title": "My Story",
  "summary": "This is a summary of my story."
}
```

#### Update story

```http
  PUT /stories/${id}
```

**Parameters:**
| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `string` | **Required**. Id of story to update |

**Body:**
| Field     | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `title`   | `string` | **Required**. New title of the story |

**Example Body:**
```json
{
  "title": "Updated Story Title"
}
```

#### Delete story

```http
  DELETE /stories/${id}
```

| Parameter   | Type     | Description                       |
| :---------- | :------- | :-------------------------------- |
| `id`        | `string` | **Required**. Id of story to delete |
| `content`   | `string` | **Required**. Content of the story |
| `story_id`  | `integer`| **Required**. Id of the story     |

### Chapters

#### Get all chapters

```http
  GET /chapters
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| None      |          | Retrieves all chapters.    |

#### Get chapter

```http
  GET /chapters/${id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `string` | **Required**. Id of chapter to fetch |

#### Get chapter choices

```http
  GET /chapters/${id}/choices
```

| Parameter | Type     | Description                              |
| :-------- | :------- | :--------------------------------------- |
| `id`      | `string` | **Required**. Id of chapter to fetch choices for |

#### Create chapter

```http
  POST /chapters
```

**Parameters:**
| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| None      |          |                            |

**Body:**
| Field         | Type         | Description                       |
| :------------ | :----------- | :-------------------------------- |
| `title`       | `string`     | **Required**. Title of the chapter |
| `content`     | `string`     | **Required**. Content of the chapter |
| `image`       | `string/null`| Image associated with the chapter |
| `story_id`    | `integer`    | **Required**. Id of the story     |
| `start`       | `boolean`    | Whether the chapter is the start  |

**Example Body:**
```json
{
  "title": "Chapter 1",
  "content": "This is the first chapter.",
  "image": null,
  "story_id": 1,
  "start": true
}
```

#### Update chapter

```http
  PUT /chapters/${id}
```

**Parameters:**
| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `string` | **Required**. Id of chapter to update |

**Body:**
| Field     | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `title`   | `string` | **Required**. New title of the chapter |

**Example Body:**
```json
{
  "title": "Updated Chapter Title"
}
```

#### Delete chapter

```http
  DELETE /chapters/${id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `string` | **Required**. Id of chapter to delete |

### Choices

#### Get all choices

```http
  GET /choices
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| None      |          | Retrieves all choices.     |

#### Get choice

```http
  GET /choices/${id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `string` | **Required**. Id of choice to fetch |

#### Create choice

```http
  POST /choices
```

**Parameters:**
| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| None      |          |                            |

**Body:**
| Field            | Type         | Description                       |
| :--------------- | :----------- | :-------------------------------- |
| `text`           | `string`     | **Required**. Text of the choice  |
| `chapter_id`     | `integer`    | **Required**. Id of the chapter   |
| `next_chapter_id`| `integer/null`| Id of the next chapter (optional) |

**Example Body:**
```json
{
  "text": "Choose this option.",
  "chapter_id": 1,
  "next_chapter_id": 2
}
```

#### Update choice

```http
  PUT /choices/${id}
```

**Parameters:**
| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `string` | **Required**. Id of choice to update |

**Body:**
| Field     | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `text`    | `string` | **Required**. New text of the choice |

**Example Body:**
```json
{
  "text": "Updated choice text."
}
```

#### Delete choice

```http
  DELETE /choices/${id}
```

| Parameter   | Type     | Description                       |
| :---------- | :------- | :-------------------------------- |
| `id`        | `string` | **Required**. Id of choice to delete |
| `content`   | `string` | **Required**. Content of the choice |
| `story_id`  | `integer`| **Required**. Id of the story     |



## Further Improvment

To make this game creator more complete, consider adding an authentication system with users and admins. At this state of the project, everyone can do everything. Nothing is secure


## You got shrimped
```
   ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢀⣀⣀⣀⡀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
⠀⠀⠀⠀⠀⠀⢀⣠⠴⢒⣋⡭⠭⠭⠿⠿⠯⠯⠭⢵⣒⣲⡤⢄⣀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
⠀⠀⠀⠀⢠⠞⣡⠾⠋⠁⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠉⠙⠚⠯⢷⣲⠤⣀⡀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
⠀⠀⠀⢀⡟⣸⠋⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠈⠉⠒⠯⢽⣒⣦⠤⣄⣀⣀⡀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
 ⠀⠀⠀⣧⣿⠀⠀⠀⠀⠀⢀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠈⠉⠙⠒⠒⠛⠛⠛⠛⠛⠛⠛⠛⠋⠁⠀⠀⠀⠀⠀
⠀⠀⠀⠀⠘⢾⡄⠀⢀⡤⣄⡈⠙⠲⠶⢶⣷⣾⣶⣿⣷⣿⣿⣿⣾⣶⣤⣴⣄⣀⣀⣀⡀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
⠀⠀⠀⠀⠀⠀⠙⢿⣭⣉⢽⡿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣶⣶⣄⣀⣀⡀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
⠀⠀⠀⠀⠀⠀⠀⠀⠀⠉⠛⠿⣶⣶⣽⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣶⣿⣿⣷⣦⣄⢀⠀⠀⠀⠀⠀⠀
⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠈⠉⢉⣛⣚⡛⠻⠿⢿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣷⣤⡀⠀⠀⠀
⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠈⠛⠛⠛⠛⣛⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣆⠀⠀
⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢀⣤⣾⣿⣷⣿⠿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⢯⣆⠀
⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠉⣠⡾⠋⠀⣸⡿⠛⠿⢾⣿⡿⠿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⡆
⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢰⡟⠀⢀⣼⡟⠁⠀⠀⠀⠙⠷⠤⣤⠈⠉⠉⠉⠉⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⡇
⠀⠀ ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠚⣿⠁⠀⣀⣸⣷⣶⣤⡀⠀⠀⠀⠀⠀⣼⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⠿⡇
⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢸⣿⣿⣿⣿⣿⣿⣷⣤⡀⠀⠀⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⡿⠁
⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢸⣿⣿⣿⣿⣿⣿⣿⣿⣿⣦⣄⢙⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⠃⠀
⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠈⠛⠿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⡿⠁⠀⠀
⠀ ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠉⠛⠻⠿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⡿⠋⠀⠀⠀⠀
⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠉⠛⠿⠿⣿⣿⣿⣿⡿⠿⠟⠛⠋⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀

```
