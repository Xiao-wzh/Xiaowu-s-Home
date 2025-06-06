package com.portfolio.controller;

import com.portfolio.entity.Profile;
import com.portfolio.service.ProfileService;
import io.swagger.v3.oas.annotations.Operation;
import io.swagger.v3.oas.annotations.Parameter;
import io.swagger.v3.oas.annotations.media.Content;
import io.swagger.v3.oas.annotations.media.Schema;
import io.swagger.v3.oas.annotations.responses.ApiResponse;
import io.swagger.v3.oas.annotations.responses.ApiResponses;
import io.swagger.v3.oas.annotations.tags.Tag;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

@RestController
@RequestMapping("/api/profile")
@Tag(name = "profile", description = "个人简介API")
public class ProfileController {

    @Autowired
    private ProfileService profileService;
    
    @Operation(summary = "获取个人简介", description = "根据ID获取个人简介信息")
    @ApiResponses(value = {
        @ApiResponse(responseCode = "200", description = "成功获取个人简介", 
                   content = @Content(mediaType = "application/json", schema = @Schema(implementation = Profile.class))),
        @ApiResponse(responseCode = "404", description = "未找到指定ID的个人简介"),
        @ApiResponse(responseCode = "500", description = "服务器内部错误")
    })
    @GetMapping("/{id}")
    public ResponseEntity<Profile> getProfile(
            @Parameter(description = "个人简介ID", required = true) @PathVariable Long id) {
        Profile profile = profileService.getProfile(id);
        if (profile != null) {
            return ResponseEntity.ok(profile);
        }
        return ResponseEntity.notFound().build();
    }
    
    @Operation(summary = "更新个人简介", description = "更新个人简介信息")
    @ApiResponses(value = {
        @ApiResponse(responseCode = "200", description = "成功更新个人简介"),
        @ApiResponse(responseCode = "400", description = "请求参数错误"),
        @ApiResponse(responseCode = "500", description = "服务器内部错误")
    })
    @PostMapping
    public ResponseEntity<Void> updateProfile(
            @Parameter(description = "个人简介对象", required = true) @RequestBody Profile profile) {
        profileService.updateProfile(profile);
        return ResponseEntity.ok().build();
    }
} 