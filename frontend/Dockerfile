FROM node:lts-alpine

WORKDIR /app

COPY package.json /app/package.json

RUN npm install

CMD ["npm", "run", "dev"]