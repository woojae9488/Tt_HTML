module.exports = {
  apps : [{
    name: 'app',
    script: './main.js',
    autorestart: true,
    watch: true,
    ignore_watch: "Data/*",
    env: {
      NODE_ENV: "development",
    },
    env_production: {
      NODE_ENV: "production",
    }
  }]
}