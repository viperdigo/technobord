
pipeline {
  environment {
    gitRepositoryUrl = "https://github.com/viperdigo/technobord.git"
    imagenameApp = "registry.rad.app.br/technobord-app"
    imagenameWeb = "registry.rad.app.br/technobord-web"
    registryUrl = "https://registry.rad.app.br"
    registryCredential = 'registry-credentials'
    dockerImageApp = ''
    dockerImageWeb = ''
  }
  agent any
  stages {
    stage('Cloning Git') {
      steps {
        git([url: gitRepositoryUrl, branch: 'master', credentialsId: '8e958a5e-77b7-4857-9437-54a83625827d'])
      }
    }
    stage('Building App Image') {
      steps{
        script {
          dockerImageApp = docker.build imagenameApp
        }
      }
    }
    stage('Building Web Image') {
          steps{
            script {
              sh "docker build -f Dockerfile.nginx -t $imagenameWeb:$BUILD_NUMBER ."
              sh "docker build -f Dockerfile.nginx -t $imagenameWeb:latest ."
            }
          }
        }
    stage('Push Images') {
      steps{
        script {
          docker.withRegistry( registryUrl, registryCredential ) {
            dockerImageApp.push("$BUILD_NUMBER")

            sh "docker push $imagenameWeb:$BUILD_NUMBER"
            sh "docker push $imagenameWeb:latest"
          }
        }
      }
    }
  }
}
