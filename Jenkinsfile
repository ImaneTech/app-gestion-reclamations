pipeline {
    agent any

    stages {
        stage('Clone') {
            steps {
                git url: 'https://github.com/ImaneTech/app-gestion-reclamations.git', 
                    branch: 'main'
            }
        }

        stage('Tests') {
            steps {
                // Use 'sh' and standard Linux file testing
                sh 'test -f index.html && echo "index.html exists"'
                sh 'test -f style.css && echo "style.css exists"'
                sh 'test -f script.js && echo "script.js exists"'
            }
        }

        stage('Build Docker Image') {
            steps {
                // This requires Docker to be installed inside your Jenkins container
                sh 'docker build -t app-reclamations:latest .'
            }
        }

        stage('Deploy') {
            steps {
                // Linux syntax for stopping/removing containers
                sh '''
                    docker stop app-reclamations || true
                    docker rm app-reclamations || true
                    docker run -d -p 80:80 --name app-reclamations app-reclamations:latest
                '''
            }
        }
    }

    post {
        success { echo 'Pipeline reussi!' }
        failure { echo 'Pipeline echoue!' }
    }
}