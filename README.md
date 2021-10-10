# 4ww3project

## part 1

### a. Live Server
http://3.142.111.3/4ww3project/part_1/

### b. Team Member
* Group name: RandName();
* Member 1: Fang Ye - yef10, 400273067
* Member 2: Haoyang Tao - taoh4, 400171589

### c. Notes

**1. Add-on 1 task 1 and task 2 were completed**

**2. Task 2 Answers**

i):   
There are three images in total: small, medium and large. For smaller device, larger image is cropped to smaller size.
```
<picture>
  <source
    srcset="img/coffee-shop-1-sma.jpg 320w,
            img/coffee-shop-1-mid.jpg 800w,
            img/coffee-shop-1.jpg 1200w"
    sizes="(min-width: 60rem) 80vw,
           (min-width: 40rem) 90vw, 100vw">
  <img src="img/coffee-shop-1-sma.jpg" alt="Coffee Shop"/>
</picture>
```

ii):  
1. It makes responsive display much easier and flexible.
2. After sets the properties, it is automatic and smart to adapt to different screen size and orientation of the phone.
3. It switches to different images depending on the resolution of the device, which will make the layout more reasonable on portable devices, and possibly speed up the loading time on smart phones.

iii):  
It is not supported by all browsers. Adding the `<img>` tag at the end will mitigate the problem. As browsers that do not support `<picture>` will directly display whatever image under the `<img>` tag.
