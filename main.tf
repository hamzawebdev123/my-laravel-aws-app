provider "aws" {
  region     = "us-east-1"
 
}

# 1. Create a Security Group (Firewall)
resource "aws_security_group" "laravel_sg" {
  name        = "laravel_sg"
  description = "Allow Web and SSH traffic"

  ingress {
    from_port   = 22
    to_port     = 22
    protocol    = "tcp"
    cidr_blocks = ["0.0.0.0/0"] # SSH access
  }

  ingress {
    from_port   = 80
    to_port     = 80
    protocol    = "tcp"
    cidr_blocks = ["0.0.0.0/0"] # HTTP access
  }

  egress {
    from_port   = 0
    to_port     = 0
    protocol    = "-1"
    cidr_blocks = ["0.0.0.0/0"]
  }
}

# 2. Launch EC2 Instance with Docker Pre-installed
resource "aws_instance" "laravel_server" {
  ami           = "ami-04b70fa74e45c3917" # Ubuntu 24.04 LTS (Region: us-east-1)
  instance_type = "t3.micro"             # Sasta aur credits save karega
  key_name      = "laravel-key"               # Iska naam wohi rakhen jo aapne AWS pe banaya hai

  security_groups = [aws_security_group.laravel_sg.name]

  # Yeh script server bante hi khud chale gi (Magic Script)
  user_data = <<-EOF
              #!/bin/bash
              sudo apt-get update -y
              sudo apt-get install -y docker.io
              sudo systemctl start docker
              sudo systemctl enable docker
              sudo usermod -aG docker ubuntu
              EOF

  tags = {
    Name = "Laravel-Automation-Server"
  }
}

output "server_ip" {
  value = aws_instance.laravel_server.public_ip
}