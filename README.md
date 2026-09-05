# haresh.acadnet.net

Personal portfolio — Sai Haresh Anand S.

B.Tech CS (AI & ML), IcfaiTech Hyderabad. I build agent systems and then evaluate them adversarially.

## Stack
Server-rendered PHP on Apache, no build step, no framework. Scroll-driven 3D built on CSS transforms with a WebGL accent layer.

## Structure
| File | Purpose |
|---|---|
| `about.php` | Home (set as `DirectoryIndex`) |
| `projects.php` | Project detail |
| `contact.php` | Contact, includes form handling |
| `index.php` | 301-redirects to `about.php` |
| `.htaccess` | Rewrites, extensionless URLs |

## Deploy
Upload to the web root on the acadnet.net host. `.htaccess` requires Apache with `mod_rewrite`.
