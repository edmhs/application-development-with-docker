PROJECT=gitea 

run:
	docker-compose -f docker-compose.yml --project-name $(PROJECT) up -d

down:
	docker-compose -f ./docker-compose.yml --project-name $(PROJECT) down

logs:
	docker-compose -f ./docker-compose.yml --project-name $(PROJECT) logs -f
