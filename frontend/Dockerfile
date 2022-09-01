FROM node:16.17.0-alpine AS builder

WORKDIR /app_frontend
COPY package.json .
RUN npm install

FROM builder AS target
ENTRYPOINT [ "npm", "run", "dev" ]
