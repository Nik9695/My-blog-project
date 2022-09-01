FROM node:16.17.0-alpine

WORKDIR /app
COPY . .
COPY package.json .
RUN npm install

CMD [ "npm", "run", "dev", "--", "--port", "8080"]
