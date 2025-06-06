package com.portfolio.controller;

import com.portfolio.entity.Project;
import com.portfolio.service.ProjectService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@RestController
@RequestMapping("/api/projects")
public class ProjectController {

    @Autowired
    private ProjectService projectService;
    
    @GetMapping
    public ResponseEntity<List<Project>> getAllProjects() {
        return ResponseEntity.ok(projectService.getAllProjects());
    }
    
    @GetMapping("/{id}")
    public ResponseEntity<Project> getProjectById(@PathVariable Long id) {
        Project project = projectService.getProjectById(id);
        if (project != null) {
            return ResponseEntity.ok(project);
        }
        return ResponseEntity.notFound().build();
    }
    
    @PostMapping
    public ResponseEntity<Boolean> createProject(@RequestBody Project project) {
        return ResponseEntity.ok(projectService.saveProject(project));
    }
    
    @PutMapping("/{id}")
    public ResponseEntity<Boolean> updateProject(@PathVariable Long id, @RequestBody Project project) {
        project.setId(id);
        return ResponseEntity.ok(projectService.updateProject(project));
    }
    
    @DeleteMapping("/{id}")
    public ResponseEntity<Boolean> deleteProject(@PathVariable Long id) {
        return ResponseEntity.ok(projectService.deleteProject(id));
    }
} 