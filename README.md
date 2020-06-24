# Automated Acceptance Testing

This is an example plugin, with acceptance tests written with Codeception, running in Docker

## Requirements

- [Docker](https://www.docker.com/community-edition)
- Add your plugin path to the shared paths in Docker -> Preferences... -> File Sharing

## Setup

- Copy `.env.sample` to `.env.local`
- Fill out your [Mailtrap](https://mailtrap.io/) details for email testing

## Running Tests

- Ensure you are in the repository root dir
- `sh bin/run-acceptance-tests.sh`

To view the tests being performed if you are on a Mac, open vnc://localhost:5900 in Safari to watch the tests running in Chrome. If you’re on Windows, you’ll need a VNC client. Password: secret.

## Writing Tests

Add new tests to `/acceptance-tests/acceptance`

## Development

To rebuild the Docker image after making changes to the docker config files:

- Run again `sh bin/run-acceptance-tests.sh --dev`

The nuclear option is 

- Stop containers that around running `docker-compose down`
- Delete all containers `docker rm -f $(docker ps -a -q)`
- Delete all volumnes `docker volume rm $(docker volume ls -q)`
- Rebuild `docker-compose build`
- Run again `sh bin/run-acceptance-tests.sh`

To ssh into the Docker container:

- Get the container ID for the WordPress latest container with `docker-compose ps`
- Run `docker exec -ti <container_id> /bin/bash`