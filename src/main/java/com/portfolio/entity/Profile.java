package com.portfolio.entity;

import com.baomidou.mybatisplus.annotation.IdType;
import com.baomidou.mybatisplus.annotation.TableId;
import com.baomidou.mybatisplus.annotation.TableName;
import lombok.Data;

@Data
@TableName("profile")
public class Profile {
    @TableId(type = IdType.AUTO)
    private Long id;
    private String name;
    private String title;
    private String subtitle;
    private String availability;
    private String coffeeText;
    private String skills;
    private String qualities;
    private String contact;
    private String social;
} 