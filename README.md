# Dynamic Servers

## About

**Dynamic Servers** is a web service to manage the IP addresses of small and private game servers with dynamic addresses.

It automatically notifies you and your users about the (mostly) daily change of your servers IP address.
You can be notified via following channels:

- Mail
- Discord

<br />

## How it works

Your gameserver sends a simple HTTP request once in a while to the **Dynamic Servers** host.
The host will notice when your IP address changes, and proceeds to send a notification to your configured channels.

Your players will be able to look up your gameservers IP via direct link, or copy it from the notification, if configured.

<br />

## Setup

Of course, you can host **Dynamic Servers** by yourself too, if you want to.

<br />

1. Clone the repository to your webserver
```
git clone https://github.com/vollborn/dynamic-servers
```

2. Install composer
```
composer install
```

3. Build the front end

Yarn:
```
yarn && yarn production
```

NPM:
```
npm install && npm run production
```


4. Copy .env.example to .env and edit the entries as needed


5. Migrate and seed
```
php artisan migrate --seed
```

6. Direct your requests to the /public directory

<br />

Here we go! **Dynamic Servers** should be up and running!
