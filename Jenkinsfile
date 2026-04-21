pipeline {
    agent any

    stages {

        stage('Clone') {
            steps {
                git branch: 'main',
                    url: 'https://github.com/ImaneTech/app-gestion-reclamations.git'
            }
        }

        stage('Tests') {
            steps {
                sh 'test -f index.html'
            }
        }

        stage('Build') {
            steps {
                sh 'docker build -t app-reclamations:latest .'
            }
        }

        stage('Deploy') {
            steps {
                sh '''
                    docker stop app-reclamations || true
                    docker rm app-reclamations || true
                    docker run -d -p 80:80 --name app-reclamations app-reclamations:latest
                '''
            }
        }
    }

    post {
        success { echo 'SUCCESS' }
        failure { echo 'FAILED' }
    }
}