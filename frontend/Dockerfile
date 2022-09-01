FROM node:lts-alpine

WORKDIR /app_frontend

COPY package.json /app_frontend/package.json

RUN npm install

CMD ["npm", "run", "dev"]